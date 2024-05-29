<?php

namespace App\Providers;

use App\Services\Impl\UserServiceImpl;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * // note providers yang kita buat harus di registrasikan
     * // untuk registrasikan nya di file ../bootstrap/app.php atau ../config/app.php
     * // kalau ../config/app.php
     * // 'providers' => [ App\Providers\UserServiceProvider::class, ]
     */

    // buat mejadi singletone
    // jika ada yang butuh UserService nanti akan di inject UserServiceImpl
    public array $singletons = [
        UserService::class => UserServiceImpl::class,
    ];

    public function provides(): array
    {
        // service yang telah di buat di registrasikan, dan dibuat lazy
        return [UserService::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
