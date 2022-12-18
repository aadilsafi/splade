<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\Resource;
use App\Models\Topic;
use App\Models\User;
use App\Models\Wysiwig;
use App\ViewModel\Category\Course\CourseViewModel;
use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\Attempt\AttemptViewModel;
use App\ViewModel\User\UserViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Peopleaps\Scorm\Entity\Sco;
use Peopleaps\Scorm\Model\ScormModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        if (auth()->user()->isAdmin){
            return $this->adminDashboard();
        }else{
            return $this->userDashboard();
        }
    }

    private function adminDashboard(){
        $stats = (object)[
            'total_users'   =>  User::has('profile')->count(),
            'total_courses' =>  Course::count(),
            'total_topics'  =>  Topic::count(),
            'active_users'  =>  User::has('profile')->where('last_active_at','>', Carbon::now()->subMinutes(10))->count()
        ];

        $recently_added_users = UserViewModel::getMultipleUsersViewModel(User::has('profile')->orderBy('created_at')->limit(3)->get());

        $activities = (object)[
          'quizzes'     => Quiz::count(),
          'wysiwygs'    => Wysiwig::count(),
          'resources'   => Resource::count(),
          'scorm'       => ScormModel::count(),
        ];


        return view('lms.dashboard', compact('stats', 'recently_added_users', 'activities'));
    }

    private function userDashboard(){
        $user = auth()->user();
        $total_quizzes = $user->quiz_reports()->count() ?? 0;
        $total_enrolled_courses = $user->courses()->count() ?? 0;
        $total_score = $user->quiz_reports->sum('score');
        // dd($total_enrolled_courses);
        $total = $user->attempts();
        // dd($total);
        $user = UserViewModel::getSingleUserViewModel($user);
        $courses = $user->courses;
        return view('lms.dashboard', compact('user', 'courses'));
    }
}
