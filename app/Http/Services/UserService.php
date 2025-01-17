<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function getUserById($id): User
    {
        return User::findOrFail($id);
    }

    public function getAuthUser(): User
    {
        return Auth::user();
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function generateToken(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token' => $user->createToken('api-token')->plainTextToken, 'user' => $user];
    }
}
