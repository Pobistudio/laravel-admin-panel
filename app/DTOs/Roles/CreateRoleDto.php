<?php

namespace App\DTOs\Roles;

use App\Http\Requests\Roles\CreateRoleRequest;

class CreateRoleDto
{
    public function __construct(
        public string $name,
        public ?string $childRoles = null,
    ) {}

    public static function fromRequest(CreateRoleRequest $request)
    {
        return new self(
            name: $request->validated('name'),
            childRoles: $request->validated('child_roles') ?? '',
        );
    }
}
