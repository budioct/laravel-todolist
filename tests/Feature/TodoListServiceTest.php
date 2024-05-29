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

    public function testGetTodoListEmpty(){

        var_dump($this->todolistService->getTodoList());
        self::assertEquals([], $this->todolistService->getTodoList());

    }

    public function testGetTodoListNotEmpty(){

        $expected = [
            [
                "id" => "1",
                "todo" => "budhi"
            ],
            [
                "id" => "2",
                "todo" => "jamal"
            ],
        ];

        $this->todolistService->saveTodo("1", "budhi");
        $this->todolistService->saveTodo("2", "jamal");
        var_dump($this->todolistService->getTodoList());

        self::assertEquals($expected, $this->todolistService->getTodoList());
    }

    public function testRemoveTodo(){

        $this->todolistService->saveTodo("1", "budhi");
        $this->todolistService->saveTodo("2", "jamal");
        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo("3");
        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo("1");
        self::assertEquals(1, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo("2");
        self::assertEquals(0, sizeof($this->todolistService->getTodoList()));
    }

}
