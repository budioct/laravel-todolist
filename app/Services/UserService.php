<?php

namespace App\Services;

interface UserService
{

    // note service yang kita buat harus di registrasikan di providers

    function login(string $user, string $password): bool;

}
