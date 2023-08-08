<?php

namespace App\Http\Services;

use App\Helpers\ApiResponse;
use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Interfaces\UserServiceInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService implements UserServiceInterface
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo) 
    {
        $this->userRepo = $userRepo;
    }


    public function login($data)
    {
        // Your logic to create a user goes here
        $email = $data['email'];
        $password = $data['password'];
        $user = $this->userRepo->findUserByEmail($email);
        if (!$user) {
            return ApiResponse::error('User not found', null);
        }

        if (!$user->authenticate($password)) {
            return ApiResponse::error('Invalid password', null);
        }

        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return ApiResponse::error('Unauthorized', 401);
        }

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];

        return ApiResponse::success($data, null);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];

        return ApiResponse::success($data, null);

    }

}