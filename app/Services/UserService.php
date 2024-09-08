<?php

namespace App\Services;

interface UserService
{
    function Login(string $user, string $password): bool;
}
