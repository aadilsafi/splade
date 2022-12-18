<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\ViewModel\Category\Course\CourseViewModel;
use App\ViewModel\User\UserViewModel;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Services\Interfaces\ImageServiceInterface;
use App\Utils\Common\EnrollmentTypes;
use App\Utils\Common\UserRoles;
use App\Utils\FilePaths;
use App\Utils\Helper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public $ImageService;
    public function __construct(ImageServiceInterface $ImageService)
    {
        $this->ImageService = $ImageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\JsonResponse
     */
    public function index(Category $category)
    {
        if (request()->ajax()) {
            $courses = CourseViewModel::getMultipleCoursesViewModel($category->courses);
            return response()->json($courses);
        }
        return view('lms.categories.show', compact('category'));
    }

    public function reorder(Request $request)
    {
        $reorder = false;
        if(auth()->user()->isAdmin) {
            $reorder = $this->reorderModel(new Course(), $request->id, $request->position, 'category_id');
        }
        return response()->json($reorder, 200);
    }

    public function create(Category $category)
    {
        return view('lms.courses.add', compact('category'));
    }
    public function edit(Category $category, Course $course)
    {
        $course = CourseViewModel::getSingleCourseViewModel($course);
        return view('lms.courses.edit', compact('course', 'category'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CourseRequest $request, Category $category)
    {
        try {

            $data = $request->validated();
            $data['position'] = $category->courses()->max('position') + 1;
            $data['slug'] = Str::slug($data['slug']);
            $courseData = collect($data)
                ->except(['redirect_to_show', 'cover_image'])
                ->toArray();
            $course = $category->courses()->create($courseData);
            if ($request->hasFile('cover_image')) {
                $image = $request->cover_image;
                $image_name = "cover_image." . $image->getClientOriginalExtension();
                $path       = FilePaths::COURSES_DIRECTORY . '/' . $course->id . '/';
                $loc      = $this->ImageService->saveImage($image, $image_name, $path);
                $course->update(['cover_image' => $loc]);
            }

            $this->createFlashMessage('Course Created Successfully', 'alert-success');

            if ($data['redirect_to_show'] == 'true') {
                return redirect()->route('category.course.show', ['category' => $category, 'course' => $course]);
            }
            return redirect()->route('category.course.index', ['category' => $category]);
        } catch (Exception $ex) {
            Helper::log("#### Course Store Error #### ", Helper::getExceptionInfo($ex));
            $this->createFlashMessage('Unable To Save Course! Please Try Again', 'alert-danger');
            return redirect()->route('category.course.index', ['category' => $category]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @param Course $course
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function show(Category $category, Course $course)
    {
        $users              = User::has('profile')->get();
        if(!auth()->user()->isAdmin && !auth()->user()->courses->contains($course)){
            return redirect()->back();
        }
        $enrolled_users     = UserViewModel::getMultipleUsersViewModel($course->users, false);
        $course             = CourseViewModel::getSingleCourseViewModel($course);
        $users              = UserViewModel::getMultipleUsersViewModel($users, false);
        $enrollment_types   = EnrollmentTypes::ALL;

        return view('lms.courses.show', compact('category', 'course','enrolled_users', 'users', 'enrollment_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CourseRequest $request, Category $category, Course $course)
    {
        if ($course->category_id == $category->id) {
            $data = $request->validated();
            $courseData = collect($data)
                ->except(['redirect_to_show', 'cover_image'])
                ->toArray();
            $course->update($courseData);
            if ($request->hasFile('cover_image')) {
                $this->ImageService->deleteImage($course->cover_image);
                $image = $request->cover_image;
                $image_name = "cover_image." . $image->getClientOriginalExtension();
                $path       = FilePaths::COURSES_DIRECTORY . '/' . $course->id . '/';
                $loc      = $this->ImageService->saveImage($image, $image_name, $path);
                $course->update(['cover_image' => $loc]);
            }

            $this->createFlashMessage('Course Updated Successfully', 'alert-success');

            if ($data['redirect_to_show'] == 'true') {
                return redirect()->route('category.course.show', ['category' => $category, 'course' => $course]);
            }
            return redirect()->route('category.course.index', ['category' => $category]);
        }
        $this->createFlashMessage('Course Updated Failed! Please Try Again', 'alert-danger');
        return redirect()->route('category.course.index', ['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Category $category, Course $course)
    {
        $category->courses()
            ->where('position', '>', $course->position)
            ->update([
                'position' => DB::raw('position - 1')
            ]);
        $course->delete();
        $this->createFlashMessage('Course Deleted Successfully', 'alert-danger');
        return redirect()->route('category.course.index', ['category' => $category]);
    }
    public function enroll(Category $category, Course $course, Request $request)
    {
        $ids = $request->user_ids;
        $extra = array_map(function ($id) use ($request) {
            return ['user_id' => $id, 'enrollment_type' => $request->enrollment_type];
        }, $ids);
        $data = array_combine($ids, $extra);
        $category->courses()->find($course->id)->users()->syncWithoutDetaching($data);
        return back();
    }
    public function disenroll(Category $category, Course $course, Request $request)
    {
        $category->courses()->find($course->id)->users()->detach($request->user_ids);
        return back();
    }
}
