<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private UserService $userService; // Dependency Injection

    public function __construct(UserService $userService)
    {
        // supaya Dependency injection di object controller bisa di gunakan
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()
            ->view("user.login", [
                "title" => "Login",
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input("user");
        $password = $request->input("password");

        // validate
        // empty(variable): bool // check apakah variable: null / empty / blank
        if (empty($user) || empty($password)) {
            return response()
                ->view("user.login", [
                    "title" => "Login",
                    "error" => "User or password is required"
                ]);
        }

        // success login
        if ($this->userService->login($user, $password)) {
            $request->session()->put("user", $user); // akan membuat session dengan key user
            return redirect("/");
        }

        // failed login
        return response()->view("user.login", [
            "title" => "Login",
            "error" => "user or password is wrong"
        ]);

    }

    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget("user"); // forget(key) hapus session
        return redirect("/");
    }
}
