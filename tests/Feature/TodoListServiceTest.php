<?php

namespace Tests\Feature;

use App\Services\TodoListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodoListServiceTest extends TestCase
{

    private TodoListService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodoListService::class);

        /**
         * jika exception: Illuminate\Contracts\Container\BindingResolutionException : Target [App\Services\UserService] is not instantiable.
         * kita harus registrasikan service ke container laravel, supaya laravel mengenali nya
         * untuk registrasikan nya di file ../bootstrap/app.php atau di ../config/app.php
         *
         * kalau ../config/app.php
         * 'providers' => [ App\Providers\TodoListService::class,]
         */

    }

    public function testTodoListService()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo(){

        $this->todolistService->saveTodo("1", "budhi");

        $todolist = Session::get("todolist"); // get(key) // get data Session
        foreach ($todolist as $value){
            self::assertEquals("1", $value["id"]);
            self::assertEquals("budhi", $value["todo"]);
        }
    }

}
