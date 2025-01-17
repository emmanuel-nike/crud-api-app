<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAuthUser()
    {
        return ['user' => $this->userService->getAuthUser()];
    }

    public function register(array $data)
    {
        return $this->userService->store($data);
    }

    public function generateToken(array $data)
    {
        return $this->userService->generateToken($data);
    }

    public function revokeAuthTokens()
    {
        return $this->userService->getAuthUser()->tokens()->delete();
    }
}
