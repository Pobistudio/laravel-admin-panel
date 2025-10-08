<?php

namespace App\DTOs\Auth;

use App\Enum\StatusEnum;
use App\Http\Requests\auths\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UpdateUserDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
    ) {}

    public static function fromRequest(string $id, UpdateUserRequest $request)
    {
        return new self(
            id: $id,
            name: $request->validated('name'),
            email: $request->validated('email'),
        );
    }
}
