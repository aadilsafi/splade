<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionBankStoreRequest;
use App\Http\Requests\QuestionBankUpdateRequest;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\QuestionViewModel;
use App\ViewModel\QuestionBank\QuestionBankViewModel;
use App\Models\Question;
use App\Models\QuestionBank;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class QuestionBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $questionBanks = QuestionBank::all();
        $questionBanks = QuestionBankViewModel::getMultipleQuestionBanksViewModel($questionBanks);
        if ($request->ajax()) {
            return response()->json($questionBanks);
        }
        return view('lms.question_banks.index', compact('questionBanks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('lms.question_banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionBankStoreRequest $request
     * @return RedirectResponse
     */
    public function store(QuestionBankStoreRequest $request)
    {
        $questionBank = QuestionBank::create($request->only('name', 'slug'));
        $this->createFlashMessage("Question Bank Created Successfully", 'alert-success');
        return redirect()->route('question-banks.index');
    }

    public function bulkUpload(Request $request)
    {

        if ($request->hasFile('file')) {
            $fillables = (new QuestionBank)->getFillable();
            $header = [];
            $full_data = [];

            $errors = [];
            foreach (file($request->file) as $key => $line) {
                $data = explode(',', str_replace("\n", "", $line));
                foreach ($data as $key2 => $column) {
                    $column = Str::lower($column);
                    if ($key == 0) {
                        $header[] = $column;
                    } else {
                        if (QuestionBank::where('slug', $column)->exists()) {
                            $errors[] = "<li> $header[$key2]: $column already exists in system </li>";
                            if (isset($full_data[$key - 1])) {
                                unset($full_data[$key - 1]);
                            }
                        } else {
                            $full_data[$key - 1][$header[$key2]] = $column;
                        }
                    }
                }

                if (count(array_diff($header, $fillables)) != 0) {
                    $errors[] = "<li>Please provide these columns " . implode(",", $fillables) . "</li>";
                    break;
                }
            }

            if (count($errors) == 0) {
                foreach ($full_data as $dd) {
                    $usrObj = QuestionBank::create($dd);
                }
                $this->createFlashMessage("Question Banks Uploaded Successfully", 'success');
                return redirect()->route('question-banks.index');
            } else {
                $message = "<br><ul class='pt-1'>" . implode('', $errors) . "</ul>";
                $this->createFlashMessage("Error While Uploading Question Banks. " . $message, 'danger');
                return redirect()->route('question-banks.index');
            }
        }

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param QuestionBank $questionBank
     * @return Application|Factory|View
     */
    public function show(QuestionBank $questionBank)
    {
        $questionBank = QuestionBankViewModel::getSingleQuestionBankViewModel($questionBank);
        return view('lms.question_banks.show', compact('questionBank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param QuestionBank $questionBank
     * @return Application|Factory|View
     */
    public function edit(QuestionBank $questionBank)
    {
        return view('lms.question_banks.edit', compact('questionBank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionBankUpdateRequest $request
     * @param QuestionBank $questionBank
     * @return RedirectResponse
     */
    public function update(QuestionBankUpdateRequest $request, QuestionBank $questionBank)
    {
        $questionBank->update($request->only('name', 'slug'));
        $this->createFlashMessage("Question Bank Updated Successfully", 'alert-success');
        return redirect()->route('question-banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param QuestionBank $questionBank
     * @return string
     */
    public function destroy(QuestionBank $questionBank)
    {
        $questionBank->delete();
        return route('question-banks.index');
    }
}
