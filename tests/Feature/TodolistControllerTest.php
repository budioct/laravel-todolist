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
                [
                    "id" => "1",
                    "todo" => "budhi"
                ],
                [
                    "id" => "2",
                    "todo" => "jamal"
                ],
            ]
        ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("budhi")
            ->assertSeeText("2")
            ->assertSeeText("jamal");

    }

    public function testAddTodoFailed()
    {

        $this->withSession([
            "user" => "budhi",
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");

    }

    public function testAddTodoSuccess()
    {

        $this->withSession([
            "user" => "budhi",
        ])->post("/todolist", [
            "todo" => "joko"
        ])->assertRedirect("/todolist");

    }

    public function testRemoveTodoList()
    {

        $this->withSession([
            "user" => "budhi",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "budhi"
                ],
                [
                    "id" => "2",
                    "todo" => "jamal"
                ],
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");

    }

}
