<?php

namespace App\DTOs\Auth;

use App\Http\Requests\LoginRequest;

class LoginDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}

    public static function fromRequest(LoginRequest $request)
    {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password')
        );
    }
}
