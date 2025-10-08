<?php

namespace App\DTOs\Users;

use App\Enum\StatusEnum;
use App\Http\Requests\Users\CreateUserRequest;

class CreateUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $roleId,
        public ?string $statusId = null,
    ) {}

    public static function fromRequest(CreateUserRequest $request, $status)
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            roleId: $request->validated('role'),
            statusId: $status ?? env('DEFAULT_USER_STATUS', StatusEnum::REGISTERED),
        );
    }
}
