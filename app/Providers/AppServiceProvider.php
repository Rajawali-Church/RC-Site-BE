<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\impl\AuthServiceImpl;
use App\Services\Event\EventService;
use App\Services\Event\impl\EventServiceImpl;
use App\Services\User\impl\UserServiceImpl;
use App\Services\User\UserService;
use App\Services\Volunteer\impl\VolunteerServiceImpl;
use App\Services\Volunteer\VolunteerService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
        $this->app->bind(EventService::class, EventServiceImpl::class);
        $this->app->bind(VolunteerService::class, VolunteerServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Factory::guessFactoryNamesUsing(function (string $model_name) {
            $namespace = '\\Database\\Factories\\';
            $model_name = Str::afterLast($model_name, '\\');
            return $namespace . $model_name . 'Factory';
        });
    }
}
