<?php

namespace App\Services\User;

use App\Http\Requests\DataTableRequest;

interface UserService
{
    public function fetch(DataTableRequest $request);
    public function createOne($full_name, $username, $password);
}