<?php

namespace App\DTOs\Auths;

use App\Http\Requests\Auths\LoginRequest;

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
