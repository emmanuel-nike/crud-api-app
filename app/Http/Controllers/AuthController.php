<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Get authenticated user
     */
    public function getAuthUser(){
        $res = $this->authService->getAuthUser();

        return response()->json($res, 200);
    }

    /**
     * Register a new user.
     */
    public function register(UserRequest $request)
    {
        $data = $request->validated();

        $user = $this->authService->register($data);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    /**
     * Generate api auth token.
     */
    public function generateToken(LoginRequest $request)
    {
        $data = $request->validated();

        $res = $this->authService->generateToken($data);

        return response()->json($res, 200);
    }

    /**
     * Revoke all auth tokens.
     */
    public function revokeAuthTokens()
    {
        $this->authService->revokeAuthTokens();

        return response()->json(['message' => 'Tokens revoked successfully'], 200);
    }
}
