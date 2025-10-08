<?php

namespace App\DTOs\Users;

use App\Http\Requests\Users\UpdateUserRequest;

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
