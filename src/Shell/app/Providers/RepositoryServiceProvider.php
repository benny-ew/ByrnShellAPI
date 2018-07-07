<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\IUserInterface','App\Repositories\UserRepository');
        $this->app->bind('App\Interfaces\IRoleInterface','App\Repositories\RoleRepository');
        $this->app->bind('App\Interfaces\IUserRoleInterface','App\Repositories\UserRoleRepository');
        $this->app->bind('App\Interfaces\ITreeInterface','App\Repositories\TreeRepository');
        $this->app->bind('App\Interfaces\INotificationInterface','App\Repositories\NotificationRepository');
        $this->app->bind('App\Interfaces\ILoginHistoryInterface','App\Repositories\LoginHistoryRepository');
    }
}
