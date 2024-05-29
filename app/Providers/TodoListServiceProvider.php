<?php

namespace App\Providers;

use App\Services\Impl\TodoListServiceImpl;
use App\Services\TodoListService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodoListServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * // note providers yang kita buat harus di registrasikan
     * // untuk registrasikan nya di file ../bootstrap/app.php atau ../config/app.php
     * // kalau ../config/app.php
     * // 'providers' => [ App\Providers\TodoListService::class, ]
     */

    // buat mejadi singletone
    // jika ada yang butuh TodoListService nanti akan di inject TodoListServiceImpl
    public array $singletons = [
        TodoListService::class => TodoListServiceImpl::class,
    ];

    public function provides(): array
    {
        // service yang telah di buat di registrasikan, dan dibuat lazy
        return [TodoListService::class];
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
