<?php


namespace App\Utils;

use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Payment;
use App\Models\Question;
use App\Models\Quiz;
use App\Utils\Payment_Constants\PaymentMethod;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;
use Session;


class Helper
{
    public static function getExceptionInfo($exception)
    {
        return [
            'line'      =>     $exception->getLine(),
            'trace'     =>     $exception->getTraceAsString(),
            'file'      =>     $exception->getFile(),
            'message'   =>     $exception->getMessage(),
        ];
    }
    public static function createFlashMessage($message, $class = "info")
    {
        Session::flash($class, $message);
    }
    public static function secondsToRealTime($seconds): string
    {
        if ($seconds < 59)
            return $seconds . 'Seconds';
        elseif ($seconds / 60 < 59)
            return $seconds / 60 . ' Minutes';
        elseif (($seconds / 3600) < 59)
            return ($seconds / 3600) . ' Hours';
    }
    //quiz and attempt start
    public static function isQuizRemainingTime($date, $duration): bool
    {
        return $date->diffInSeconds(Carbon::now()) < ($duration * 60);
    }
    public static function quizRemainingTimeInMinute($date, $duration): bool
    {
        $remaining_time = $duration - $date->diffInMinutes(Carbon::now());
        //if remaining time in minus then 0 otherwise remaining time
        return $remaining_time < 0 ? 0 : $remaining_time;
    }

    public static function isQuizDuration(Quiz $quiz): bool
    {
        return true;
        $start_date = Carbon::parse($quiz->start_date);
        $end_date = Carbon::parse($quiz->end_date);
        return Carbon::now()->between($start_date, $end_date);
    }
    public static function isQuestionToBeAttempt(Attempt $attempt): bool
    {
        return $attempt->created_at == $attempt->updated_at;
    }

    public static function isQuizAttemptRemainingTime($date, $duration): bool
    {
        return $duration > $date->diffInMinutes(Carbon::now());
    }
    public static function QuizAttemptRemainingTime($date, $duration): int
    {
        $totalDuration = $duration - $date->diffInSeconds(Carbon::now());
        return $totalDuration < 0 ? 0 : $totalDuration;
    }

    public static function isQuestionHaveAnswer(Question $question, $answer_id): bool
    {
        return $question->answers->contains('id', $answer_id);
    }
    public static function totalDuration($start_date, $end_date)
    {
        $start_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);
        return $start_date->diffInMinutes($end_date);
    }

    public static function isBetweenTwoDates($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        return Carbon::now()->between($startDate, $endDate);
    }
    public static function isBetweenTwoDatesWithDuration($date, $duration)
    {
        $date = Carbon::parse($date)->addMinutes(1);
        return Carbon::now()->isBefore($date->addMinutes($duration));
    }
    //quiz and attempt end

    public static function log($ident, $msg)
    {
        Log::info($ident, [
            'PATH' => request()->path(),
            'MSG' => str_replace("\n", "", var_export($msg, true)),
            'UNIQUE_ID' => isset($_SERVER['UNIQUE_ID']) ? $_SERVER['UNIQUE_ID'] : ''
        ]);
    }

    public static function getConstantData($id, $values)
    {
        try {
            return (object)[
                'id'    => $id,
                'name'  => $values[$id]
            ];
        } catch (Exception $ex) {
            dd('hereh',$id);
        }
    }

    private static function GenerateRandomNo()
    {
        return implode('-', str_split(strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9)), 5));
    }

    public static function TransactionRefNo()
    {
        do {
            $random_transaction_number  = self::GenerateRandomNo();
            $already_exist              = Payment::where('ref', $random_transaction_number)->first();
        } while (!is_null($already_exist));

        return     $random_transaction_number;
    }

    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
    public static function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public static function getTreeData($collectionData, $model)
    {
        $typesTmp = [];
        // dd($collectionData);
        // $model = "\\App\\Models\\" . $model;

        foreach ($collectionData as $key => $row) {
            $typesTmp[] = $row;
            $typesTmp[$key]["tree"] = self::getTypeParentTreeCollection($row, $row->name, $collectionData);
        }

        return $typesTmp;
        // dd($typesTmp);
    }

    public static function getTypeParentTreeCollection($row, $name, $parent): string
    {
        if ($row->parent_id == 0) {
            return $name;
        }

        $nextRow = $parent->firstWhere('id', $row->parent_id);
        $name = (is_null($nextRow) ?? empty($nextRow) ? '' : $nextRow->name) . ' > ' . $name;
        if (is_null($nextRow) ?? empty($nextRow)) {
            return $name;
        }

        return self::getTypeParentTreeCollection($nextRow, $name, $parent, $parent);
    }

    public static  function editDateColumn($date)
    {
        $date = new Carbon($date);

        return "<span>" . $date->format('H:i:s') . "</span> <br> <span class='text-primary fw-bold'>" . $date->format('Y-m-d') . "</span>";
    }

    public static function mask($title, $limit = 2)
    {
        return Str::words(Str::replace('-', ' ', Str::title($title)), $limit);
    }
}
