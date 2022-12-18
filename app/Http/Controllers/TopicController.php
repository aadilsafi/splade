<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Http\Resources\TopicResource;
use App\ViewModel\Category\Course\CourseViewModel;
use App\ViewModel\Category\Course\Topic\TopicViewModel;
use App\Models\Course;
use App\Models\Topic;
use App\Utils\Helper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Course $course
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Course $course)
    {
        if (request()->ajax()) {
            $topics = TopicViewModel::getMultipleTopicsViewModel($course->topics);
            return $this->sendResponse(TopicResource::collection($topics), "All Topics Loaded Successfully");
        }
        $category = $course->category;
        return view('lms.courses.show',compact('category','course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Course $course)
    {
        $course = CourseViewModel::getSingleCourseViewModel($course);
        return view('lms.topics.create', compact('course'));
    }

    public function edit(Course $course, Topic $topic)
    {
        if ($topic->course_id == $course->id) {
            $topic = TopicViewModel::getSingleTopicViewModel($topic);
            return view('lms.topics.edit', compact('course', 'topic'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TopicRequest $request
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TopicRequest $request, Course $course)
    {
        try {
            $data = $request->validated();
            $data['position'] = $course->topics()->max('position') + 1;
            $course->topics()->create($data);


            $this->createFlashMessage(__('lang.commons.data_saved'));
            return redirect()->route('category.course.show',[$course->category->slug, $course->slug]);
        } catch (Exception $ex) {
            Helper::log("#### Topics Store Error #### ", Helper::getExceptionInfo($ex));
            $this->createFlashMessage(__('lang.errors.something_went_wrong'), 'danger');
            return redirect()->route('category.course.show',[$course->category->slug, $course->slug]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @param Topic $topic
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    // TO:DO Middleware for course topic id
    public function show(Course $course, Topic $topic)
    {
        $topic = TopicViewModel::getSingleTopicViewModel($topic);
        return view('lms.topics.show', compact('course','topic'));
//        if ($topic->course_id == $course->id) {
//
//        }
//        $this->createFlashMessage(__('lang.errors.something_went_wrong'), 'danger');
//        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, Course $course, Topic $topic)
    {
        if ($topic->course_id == $course->id) {
            $topic->update($request->all());
            return $this->sendResponse(TopicResource::make($topic), "Topic Updated Successfully");
        }
        return $this->sendError("The topic does not belong to this course");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic, Course $course)
    {
        //To-Do Re index all the positions;
        $course->topics()
            ->where('position', '>', $topic->position)
            ->update([
                'position' => DB::raw('position - 1')
            ]);
        $course->topics($topic)->delete();
        return $this->sendResponse([], "Topic Deleted Successfully");
    }
}
