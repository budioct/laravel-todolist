<?php

namespace App\Http\Controllers;

use App\Services\TodoListService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{

    private TodoListService $todoListService; // Dependency Injection

    public function __construct(TodoListService $todoListService)
    {
        // supaya Dependency injection di object controller bisa di gunakan
        $this->todoListService = $todoListService;
    }

    public function todoList(Request $request)
    {
        $todoList = $this->todoListService->getTodoList();

        return response()
            ->view("todolist.todolist", [
                "title" => "TodoList",
                "todolist" => $todoList
            ]);
    }

    public function addTodo(Request $request)
    {

        $todo = $request->input("todo");

        $todoList = $this->todoListService->getTodoList();
        if (empty($todo)){
            return response()->view("todolist.todolist", [
                "title" => "TodoList",
                "error" => "Todo is required",
                "todolist" => $todoList,
            ]);
        }

        $this->todoListService->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class, "todoList"]);
    }

    public function removeTodo(Request $request, string $todoId)
    {

    }

}
