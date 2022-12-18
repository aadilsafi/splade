<?php

use App\Events\NewChatMessage;
use App\Events\NewTrade;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Trainer\QuestionImportController;
use App\Http\Controllers\Trainer\QuestionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConstantController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuestionBankController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Scorm\ScormController;
use App\Http\Controllers\Scorm\ScormTrackController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\Trainee\AttemptController;
use App\Http\Controllers\Trainer\QuizController;
use App\Models\Activity;
use App\Models\Course;
use App\Models\User;
use App\Utils\Common\ActivityTypes;
use App\Utils\Helper;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Hamood's Routes Start
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

    // Profile Routes
    Route::get('profile/edit/account', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit.account');
    Route::get('profile/edit/security',  [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit.security');
    Route::put('profile/edit/account/{user}', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('user.update.profile');
    Route::put('profile/edit/security/{user}', [\App\Http\Controllers\ProfileController::class, 'updateProfileSecurity'])->name('user.update.profile.security');
    Route::resource('profile', \App\Http\Controllers\ProfileController::class);

    // User Routes
    Route::post('user/bulk-upload', [\App\Http\Controllers\UserController::class, 'bulkUpload'])->name('user.bulk.upload');
    Route::resource('user', \App\Http\Controllers\UserController::class);

    // Question Banks Routes
    Route::post('question-banks/bulk-upload', [QuestionBankController::class, 'bulkUpload'])->name('question-banks.bulk.upload');
    Route::resource('question-banks', QuestionBankController::class);

    // Question Routes
    Route::post('questions/bulk-upload', [QuestionController::class, 'bulkUpload'])->name('questions.bulk.upload');
    Route::resource('question-banks.questions', QuestionController::class);

    // Global Course Search
    Route::view('/search', 'lms.search');

    //Quiz Question Routes
    //Add question to Quiz LMS testing (temporary)
    Route::get('add-quiz-questions', [QuizController::class, 'addQuestionToQuiz'])->name('add-quiz-questions');
    Route::get('quiz-attempts', [QuizController::class, 'quizQuestionAttempt'])->name('quiz-attempts');

    //LMS Quiz Attempt
    Route::get('/lms-quiz-attempt/{quiz}', [AttemptController::class, 'lmsAttemptIndex']);



    Route::middleware('is_admin')->group(function () {
        // Category Routes
        Route::get('category/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');
        Route::get('category/destroy-selected', [CategoryController::class, 'destroySelected'])->name('categories.destroy.selected');
        Route::get('category/{category}/delete', [CategoryController::class, 'destroy'])->name('category.destroys');
        Route::get('category/{parent_id}/subcategories', [CategoryController::class, 'subCategories'])->name('category.subcategories');
        Route::resource('category', CategoryController::class);

        // Course Routes
        Route::get('course/reorder', [CourseController::class, 'reorder'])->name('courses.reorder');
        Route::post('category/{category}/course/{course}/enroll', [CourseController::class, 'enroll'])->name('category.course.enroll');
        Route::post('category/{category}/course/{course}/disenroll', [CourseController::class, 'disenroll'])->name('category.course.disenroll');
        Route::resource('category.course', CourseController::class);
    });

    // Course Routes
    Route::resource('category.course', CourseController::class)->only('show');

    // Topic Routes
    Route::resource('course.topic', TopicController::class);

    // Activity Routes
    Route::resource('topic.activity', ActivityController::class);
    //Lms Quiz Report
    Route::get('topic/{topic}/activity/{activity}/quiz-attempt', [AttemptController::class, 'lmsQuizAttemptIndex'])->name('lms.quiz.attempt.index');
    Route::post('lms-quiz-attempt', [AttemptController::class, 'lmsQuizAttemptStore'])->name('lms.quiz.attempt.store');
    Route::get('topic/{topic}/activity/{activity}/report/{quiz}', [AttemptController::class, 'lmsQuizReport'])->name('lms.quiz.attempt.report');
    // Role Routes
    //    Route::resource('roles', RoleController::class);
    //    Route::resource('report', ReportController::class);

});

Route::get('clear', function () {
    Artisan::call('cache:clear');   // Run the following command to clear the application cache of the Laravel application.
    Artisan::call('route:clear');   // To clear route cache of your Laravel application execute the following command from the shell.
    Artisan::call('config:clear');  // You can use config:clear to clear the config cache of the Laravel application.
    Artisan::call('view:clear');    // Also, you may need to clear compiled view files of your Laravel application. To clear compiled view files run the following command from the terminal.
    Artisan::call('optimize:clear');
    Artisan::call('clear-compiled');
    dd("All type of cache clear (cache, route, config, view, clear-compiled)");
});
// Hamood's Routes End

Auth::routes([
    'register' => false
]);

// Route::post('logout',[LoginController::class,'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::view('/widget', 'widget');



// trainee pages
Route::view('/student-profile', 'portal.trainee.studentprofile');

Route::get('/weekly-quizz', [QuizController::class, 'weeklyQuiz'])->name('weekly-quizz');

Route::view('/trainee-calendar', 'portal.trainee.trainingcalendar');
Route::view('/leaderboard', 'portal.trainee.leaderboard');


//Route::view('/userlist', 'users.index')->name('user.index');
//Route::view('/edituser', 'users.edit')->name('user.edit');
//Route::view('/adduser', 'users.add')->name('user.create');
// training
// Route::view('/courses', 'courses.index');
// Route::view('/courses/create', 'courses.add');

Route::get('test', function () {
    return view('test');
    $activity = Activity::find(17);
    dd($activity->content);
    $course = Course::find(1);
    // dd($course->users->pluck('id'));
    // $course = $user->courses->first();
    // dd($user->progressActivities);
    // dd($user->progressActivities()->where('user_id',3)->where('course_id',$course->id)->exists());
    //    return to_route('welcome');
});

Route::redirect('/', 'home')->name('welcome');


### QUERY LOGGING BEGIN ###
DB::listen(function ($query) {
    Helper::log("### SQL QUERY ###", [
        'QUERY'     =>      str_replace('\n', '', $query->sql),
        'BINDINGS'  =>      $query->bindings,
        'TIME'      =>      $query->time . ' ms.'
    ]);
});
### QUERY LOGGING END ###

//constants
Route::get('get-all-user-types', [ConstantController::class, 'getAllUserTypes']);

Route::middleware('auth')->group(function () {
    //Trainer Routes
    // Route::get('me',[AuthController::class,'me']);
    Route::middleware('is_trainer')->group(function () {
        //sample file download
        Route::get('/download-sample', [QuestionImportController::class, 'sampleFile'])->name('download-sample');
        //import Question
        // Route::post('import-questions', [QuestionImportController::class, 'importQuestions'])->name('import-questions');
        // Route::post('approve-questions', [QuestionImportController::class, 'approveQuestions'])->name('approve-questions');
        Route::resource('import-questions', QuestionImportController::class);

        //        Route::get('questions', [QuestionController::class, 'index'])->name('question.index');
        //        // Route::get('create-question', [QuestionController::class, 'create'])->name('question.create');
        //        Route::post('create-question', [QuestionController::class, 'store'])->name('question.store');
        //        Route::get('edit-question/{question}', [QuestionController::class, 'edit'])->name('question.edit');
        //        Route::put('update-question/{question}', [QuestionController::class, 'update'])->name('question.update');
        //        Route::delete('delete-question/{question}', [QuestionController::class, 'delete'])->name('question.destroy');
        //        Route::post('editor/upload', [QuestionController::class, 'uploadEditorImage'])->name('editor-upload');


        //quiz
    });

    //Trainee Routes
    Route::get('attempt', [AttemptController::class, 'index'])->name('attempt.index');
    Route::post('quiz-attempt/{quiz}', [AttemptController::class, 'quizAttempt'])->name('quiz-attempt');
    Route::put('/update-attempt/{attempt}', [AttemptController::class, 'updateAttempt'])->name('update-attempt');

    //temporary routes
    Route::get('my-attempt/{slug}', [AttemptController::class, 'myQuizAttempt'])->name('my-attempt');
    Route::get('test-attempt', [AttemptController::class, 'updateAttempt']);
    Route::post('quiz-attempt', [AttemptController::class, 'attemptQuestion'])->name('quiz-attempt');


    //it is of trainer
    Route::resource('quizzes', QuizController::class);
    //Admin Routes
    Route::middleware('is_admin')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
    });
});


// Route::post('topic/slug', [TopicController::class,'store']);

Route::group(['prefix' => 'admin/scorm'], function () {
    Route::post('/upload', [ScormController::class, "upload"]);
    Route::post('/parse', [ScormController::class, "parse"]);
    Route::delete('/{scormModel}', [ScormController::class, "delete"]);
    Route::get('/', [ScormController::class, "index"]);
    Route::get('/scos', [ScormController::class, "getScos"]);
});

Route::group(['prefix' => 'scorm'], function () {
    Route::get('/play/{uuid}', [ScormController::class, "show"])->name('scorm.play');

    Route::group(['prefix' => '/track'], function () {
        Route::post('/{uuid}', [ScormTrackController::class, 'set']);
        Route::get('/{scoId}/{key}', [ScormTrackController::class, 'get']);
    });
});
Route::get('delete', function () {
    DB::table('attempts')->truncate();
    dd('attempt truncated');
});

Route::get('attempt-view', function () {
    return \App\Models\AttemptView::all();
});

Route::post('test1', [AttemptController::class,'lmsQuizAttemptStore'])->name('test1');

Route::get('test2',function(){
    $user = User::find(1);
    $user->update(['email'=>'bingo@gmail.com']);
    dd($user);
    // event(new NewTrade('Bingo'));

    // redirect()->route('lms.quiz.attempt.report');
});
Route::view('listen', 'listen');

Route::view('test', 'test');
Route::middleware('splade')->group(function () {
    Route::view('/', 'welcome');
    Route::view('/contact', 'contact');
});
