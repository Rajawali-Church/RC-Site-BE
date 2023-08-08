<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddOneUserRequest;
use App\Http\Resources\User\UserIdexResource;
use App\Services\User\UserService;
use App\Shareds\ResponseStatus;
use Error;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    )
    {   
    }

    public function signup(AddOneUserRequest $request)
    {
        try {
            $data = $this->userService->createOne($request?->full_name, $request?->username, $request->password);

            return ResponseStatus::response(new UserIdexResource($data?->data), $data?->status, $data?->statusCode);
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }

    }
}
