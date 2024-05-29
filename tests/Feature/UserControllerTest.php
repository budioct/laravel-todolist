<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    public function testLoginPage()
    {

        $this->get("/login")
            ->assertSeeText("Login");

    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "budhi"
        ])->get("/login")
            ->assertRedirect("/");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "budhi"
        ])->post("login", [
            "user" => "budhi",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "budhi");
    }

    public function testLoginSuccess()
    {
        $this->post("/login", [
            "user" => "budhi",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "budhi");
    }

    public function testValidationError()
    {
        $this->post("/login", [
            "user" => null,
            "password" => "",
        ])->assertSeeText("User or password is required");
    }

    public function testLoginFailed()
    {
        $this->post("/login", [
            "user" => "wrong",
            "password" => "wrong",
        ])->assertSeeText("user or password is wrong");
    }

    public function testLogout()
    {

        $this->withSession([
            "user" => "budhi"
        ])->post("/logout")
            ->assertRedirect("/")
            ->assertSessionMissing("user");

    }

}
