<?php

namespace App\Providers;

use App\Services\Contracts\ScormServiceContract;
use App\Services\Contracts\ScormTrackServiceContract;
use App\Services\ImageService;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\NotificationServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\NotificationService;
use App\Services\ScormService;
use App\Services\ScormTrackService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageServiceInterface::class,ImageService::class);
        $this->app->bind(NotificationServiceInterface::class,NotificationService::class);
        $this->app->bind(UserServiceInterface::class,UserService::class);


        $this->app->bind(ScormServiceContract::class,ScormService::class);
        $this->app->bind(ScormTrackServiceContract::class,ScormTrackService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //
    }
}
