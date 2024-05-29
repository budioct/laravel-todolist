<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);

        /**
         * jika exception: Illuminate\Contracts\Container\BindingResolutionException : Target [App\Services\UserService] is not instantiable.
         * kita harus registrasikan service ke container laravel, supaya laravel mengenali nya
         * untuk registrasikan nya di file ../bootstrap/app.php atau di ../config/app.php
         *
         * kalau ../config/app.php
         * 'providers' => [ App\Providers\UserServiceProvider::class,]
         */

    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("budhi", "rahasia"));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login("test", "rahasia"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("budhi", "salah"));
    }


}
