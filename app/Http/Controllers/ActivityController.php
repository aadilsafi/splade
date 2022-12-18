<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Http\Requests\QuizAttemptRequest;
use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\ResourceRequest;
use App\Http\Requests\WysiwigRequest;
use App\Http\Resources\ActivityResource;
use App\ViewModel\Category\Course\Topic\Activity\ActivityViewModel;
use App\Models\Activity;
use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Quiz;
use App\Models\Resource;
use App\Models\Topic;
use App\Models\UserProgress;
use App\Models\Wysiwig;
use App\Services\Contracts\ScormServiceContract;
use App\Services\Interfaces\ImageServiceInterface;
use App\Utils\Common\ActivityTypes;
use App\Utils\Common\AttemptStatus;
use App\Utils\Common\FilePaths;
use App\Utils\Common\ResourceTypes;
use App\Utils\Common\SystemTypes;
use App\Utils\Helper;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Question\Answer\AnswerViewModel;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\QuizViewModel;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Peopleaps\Scorm\Entity\Scorm;
use Peopleaps\Scorm\Model\ScormModel;

class ActivityController extends Controller
{

    public $ImageService;
    public $scormService;
    public function __construct(ImageServiceInterface $ImageService, ScormServiceContract $scormService)
    {
        $this->scormService = $scormService;
        $this->ImageService = $ImageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\JsonResponse
     */
    public function index(Topic $topic)
    {
        if (request()->ajax()) {
            $activities = $topic->activities()->where('is_record', false)->get();
            $activities = ActivityViewModel::getMultipleActivitiesViewModel($activities);
            return response()->json($activities);
        }

        return view('lms.topics.show', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ActivityRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ActivityRequest $request, Topic $topic)
    {
        try {
            $data = $request->validated();
            $data['position'] = $topic->activities()->max('position') + 1;
            // TODO Clean the validation rules
            // dd($data['type'] == ActivityTypes::QUIZ);
            switch ($data['type']) {
                case ActivityTypes::QUIZ:
                    $activity_data = $request->validate((new QuizStoreRequest(true))->rules());
                    $quizData = Arr::except($activity_data,['question_ids','marks','bank_ids']);
                    if($quizData['duration'] != 0)
                        $quizData['duration'] = Helper::totalDuration($quizData['start_date'],$quizData['end_date']); 
                        $quizData['duration'] *= 60; //minutes to seconds
                    $quizData['trainer_id'] = auth()->id();
                    $quiz = Quiz::create($quizData);
                    //Add Question to Quiz start
                    $quizQuestions = $this->mapQuestionMarks($activity_data['question_ids'],$activity_data['marks']);
                    $quiz->questions()->sync($quizQuestions);
                    //Add Question to Quiz end
                    $data['activity_type'] = Quiz::class;
                    $data['activity_id']   = $quiz->id;
                    break;
                case ActivityTypes::RESOURCE:
                    $activity_data = $request->validate(['file' => 'required']);
                    if ($request->hasFile('file')) {
                        $file       = $request->file;
                        $file_name  = time() . '.' . $file->getClientOriginalExtension();
                        $path       = FilePaths::RESOURCE_DIRECTORY . '/';
                        $loc        = $this->ImageService->saveImage($file, $file_name, $path);
                        $activity   = Resource::create([
                            'type'      => ResourceTypes::FILE,
                            'file_size' => $file->getSize(),
                            'mime_type' => $file->getClientmimeType(),
                            'path'      => $loc

                        ]);
                    }
                    $data['activity_type'] = Resource::class;
                    $data['activity_id']   = $activity->id;
                    break;
                case ActivityTypes::SCORM:
                    $activity_data  = $request->validate(['zip' => 'required|mimes:zip']);
                    $zip            = $request->zip;
                    $scorm = $this->scormService->uploadScormArchive($zip);
                    $scorm = $this->scormService->removeRecursion($scorm);
                    $data['activity_type'] = ScormModel::class;
                    $data['activity_id']   = $scorm['model']->id;
                    break;
                case ActivityTypes::WYSIWIG:
                    $activity_data = $request->validate((new WysiwigRequest())->rules());
                    $activity = Wysiwig::create($activity_data);
                    $data['activity_type'] = Wysiwig::class;
                    $data['activity_id']   = $activity->id;
                    break;
                case ActivityTypes::ATTEMPT:
                    $activity_data = $request->validate((new QuizAttemptRequest())->rules());
                    $this->quizQuestionAttempt($activity_data['quiz'],$activity_data['answer_ids']);
                    $data['activity_type'] = Attempt::class;
                    $data['activity_id']   = $activity->id; //activity id is one but attempts are many
                    break;
            }
            $topic->activities()->create($data);
            $this->createFlashMessage('Activity Created Successfully', 'alert-success');
            return redirect()->route('course.topic.show', [$topic->course->slug, $topic->slug]);
        } catch (Exception $ex) {
            if (isset($ex->validator)) {
                return back()->withErrors($ex->validator)->withInput();
            }
            dd($ex);
            Helper::log("#### Activity Store Error #### ", Helper::getExceptionInfo($ex));
            $this->createFlashMessage('Unable To Save Activity! Please Try Again', 'alert-danger');
            return redirect()->route('course.topic.show', [$topic->course->slug, $topic->slug]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     * @param Activity $activity
     * @return Application|Factory|View
     */
    public function show(Topic $topic, Activity $activity)
    {
        $user = auth()->user();
        if (!$user->isAdmin) {
            $user->activity_progress()->syncWithoutDetaching([$activity->id => [
                'course_id'     => $activity->topic()->first()->course_id,
                'topic_id'      => $activity->topic_id,

            ]]);
        }
        $activity = ActivityViewModel::getSingleActivityViewModel($activity, false);
        return view('lms.activities.show', compact('topic', 'activity'));
    }

    public function edit(Topic $topic, Activity $activity)
    {
        $activity_types = ActivityTypes::All;
        $activity = ActivityViewModel::getSingleActivityViewModel($activity);
        return view('lms.activities.edit', compact('topic', 'activity', 'activity_types'));
    }

    public function create(Topic $topic)
    {
        $activity_types = ActivityTypes::All;
        return view('lms.activities.create', compact('topic', 'activity_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ActivityRequest $request
     * @param Topic $topic
     * @param Activity $activity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ActivityRequest $request, Topic $topic, Activity $activity)
    {
        if ($activity->topic_id == $topic->id) {
            $activity->update($request->all());
            return redirect()->route('lms.activities.index', compact('topic'));
        }
        $this->createFlashMessage('The Activity does not belong to this Topic', 'alert-danger');
        return redirect()->route('lms.activities.index', compact('topic'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Topic $topic, Activity $activity)
    {
        if ($activity->topic_id == $topic->id) {
            $topic->activities()->where('position', '>', $activity->position)
                ->update([
                    'position' => DB::raw('position - 1')
                ]);
            $activity->delete();
            $this->createFlashMessage('Activity Deleted Successfully', 'alert-success');
            return redirect()->route('lms.activities.index', compact('topic'));
        }
        $this->createFlashMessage('The Activity does not belong to this Topic', 'alert-danger');
        return redirect()->route('lms.activities.index', compact('topic'));
    }
    public function mapQuestionMarks($question_ids,$marks) : array
	{
		$questionWithMarks = [];
		foreach($question_ids as $key => $question_id)
		{
			$questionWithMarks[$question_id] = [
										'marks' => $marks[$key]
									];
		}
		return $questionWithMarks;
	}
    public function quizQuestionAttempt($quiz,$answer_ids)
	{
		
		$user = auth()->user();
		$answers = Answer::whereIn('id',$answer_ids)
							->with(['question.quizzes' => function($query) use ($quiz){
								$query->where('quizzes.id',$quiz->id);
							}])
							->get();
		$allAnswers = AnswerViewModel::getMultipleAnswersViewModel($answers,true,true);
		foreach ($allAnswers as $key => $answer) {

			$user->attempts()->create([
				'answer_id' => $answer->id,
                'question_id' => $answer->question_id,
				'is_correct' => $answer->is_correct,
				'marks'      => $answer->is_correct ? $answer->question->quizzes->first()->pivot->marks : 0,
				'type'      =>  SystemTypes::LMS,
				'quiz_id'   => $quiz->id,
				'status'    => AttemptStatus::ATTEMPTED
			]);
			
		}
	
	}

    
   
}
