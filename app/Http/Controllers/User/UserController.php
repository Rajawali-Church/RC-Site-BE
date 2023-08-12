<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataTableRequest;
use App\Http\Requests\User\AddOneUserRequest;
use App\Http\Resources\User\UserIndexResource;
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

    public function index(DataTableRequest $request)
    {
        try {
            $data = $this->userService->fetch($request);

            return ResponseStatus::response($data);
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }

    }

    public function signup(AddOneUserRequest $request)
    {
        try {
            $data = $this->userService->createOne($request?->full_name, $request?->username, $request->password);

            return ResponseStatus::response(new UserIndexResource($data?->data), $data?->status, $data?->statusCode);
        } catch (Error $err) {
            return ResponseStatus::response(['Message' => $err->getMessage()], 'Server Internal Error', 500);
        }

    }

}
