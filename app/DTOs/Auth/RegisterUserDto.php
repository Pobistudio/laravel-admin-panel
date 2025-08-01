<?php

namespace App\DTOs\Auth;

use App\Http\Requests\auths\RegisterUserRequest;

class RegisterUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $roleId,
        public ?string $statusId = null,
    ) {}

    public static function fromRequest(RegisterUserRequest $request)
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            roleId: $request->validated('role'),
            statusId: $request->validated('status'),
        );
    }
}
