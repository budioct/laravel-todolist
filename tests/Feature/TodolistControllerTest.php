<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{

    public function testTodoList()
    {

        $this->withSession([
            "user" => "budhi",
            "todolist" => [
                "id" => "1",
                "todo" => "budhi"
            ]
        ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("budhi");

    }

}
