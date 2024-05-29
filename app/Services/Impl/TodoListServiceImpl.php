<?php

namespace App\Services\Impl;

use App\Services\TodoListService;
use Illuminate\Support\Facades\Session;

class TodoListServiceImpl implements TodoListService
{

    public function saveTodo(string $id, string $todo): void
    {
        // data todo akan kita simpan di session
        // jika session dengan ke todolist tidak ada kita taruh dengan array kosong []
        if (!Session::exists("todolist")) {
            Session::put("todolist", []);
        }

        // tambahkan data todolist dengan id dan todo
        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    public function getTodoList(): array
    {
        return Session::get("todolist", []); // get() mendapatkan value dari session
    }
}
