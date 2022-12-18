<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Course;
use App\Models\QuestionBank;
use App\Models\Quiz;
use App\Models\Topic;
use App\Models\User;
use Exception;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    private function customSettings(){
        Route::bind('user', function ($value) {
            if (is_numeric($value)) {
                return User::where('id', $value)->orWhere('username', $value)->firstOrFail();
            }
            return User::where('username', $value)->firstOrFail();
        });

        Route::bind('category', function ($value) {
            if (is_numeric($value)) {
                return Category::where('id', $value)->orWhere('slug', $value)->firstOrFail();
            }
            return Category::where('slug', $value)->firstOrFail();
        });
        Route::bind('course', function ($value) {
            if (is_numeric($value)) {
                return Course::where('id', $value)->orWhere('slug', $value)->firstOrFail();
            }
            return Course::where('slug', $value)->firstOrFail();
        });
        Route::bind('topic', function ($value) {
            if (is_numeric($value)) {
                return Topic::where('id', $value)->firstOrFail();
            }
            return Topic::where('slug', $value)->firstOrFail();
        });
        Route::bind('activity', function ($value) {
            if (is_numeric($value)) {
                return Activity::where('id', $value)->orWhere('slug', $value)->firstOrFail();
            }
            return Activity::where('slug', $value)->firstOrFail();
        });
        Route::bind('question-bank', function ($value) {
            if (is_numeric($value)) {
                return QuestionBank::where('id', $value)->orWhere('slug', $value)->firstOrFail();
            }
            return QuestionBank::where('slug', $value)->firstOrFail();
        });
        // Route::bind('my-attempt', function ($value) {
        //     dd($value);
        //     if (is_numeric($value)) {
        //         return Quiz::where('id', $value)->orWhere('slug', $value)->firstOrFail();
        //     }
        //     return Quiz::where('slug', $value)->firstOrFail();
        // });
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        // Allow Models To Call Using Slug
        $this->customSettings();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
