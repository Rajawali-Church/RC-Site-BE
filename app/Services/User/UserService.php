<?php

namespace App\Services\User;

interface UserService
{
    public function createOne($full_name, $username, $password);
}