<?php

namespace App\DTOs\Users;

use App\Http\Requests\Users\ChangeUserRoleRequest;
use App\Http\Requests\Users\ChangeUserStatusRequest;

class ChangeUserRoleDto
{
    public function __construct(
        public string $id,
        public ?string $roleId,
    ) {}

    public static function fromRequest(ChangeUserRoleRequest $request, $id)
    {
        return new self(
            id: $id,
            roleId: $request->validated('role'),
        );
    }
}
