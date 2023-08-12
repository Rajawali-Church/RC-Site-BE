<?php

namespace App\Services\User\impl;

use App\Http\Requests\DataTableRequest;
use App\Models\User;
use App\Services\User\UserService;
use App\Shareds\BaseService;
use App\Shareds\Paginator;
use Error;

class UserServiceImpl extends BaseService implements UserService
{

    public function __construct(private readonly User $user)
    {
        parent::__construct($user);
    }

    public function fetch(DataTableRequest $request)
    {
        $order = $request->order ?? 'desc';
        $sort = $request->sort ?? 'id';

        $queryData = $this->user
                    ->orderBy($sort, $order);
        
        return Paginator::paginate($queryData, $request->page, $request->per_page);
    }

    public function createOne($full_name, $username, $password) {

        try {
            $user = $this->user->create(['full_name' => $full_name, 'username' => $username, 'password' => bcrypt($password, ['round' => 12])]);
        } catch (Error $err) {
            return (object) ['data' => null, 'status' => 'Server internal Error', 'statusCode' => 500];
        }

        $token = auth('api')->attempt(['username' => $username, 'password' => $password]);

        return (object) [
            'data' => [
                'user' => auth('api')->user(),
                'token' => $token
            ],
            'status' => "success",
            'statusCode' => 200,
        ];
    }
}