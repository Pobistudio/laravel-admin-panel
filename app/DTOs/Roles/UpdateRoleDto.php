<?php

namespace App\DTOs\Roles;

use App\Http\Requests\Roles\UpdateRoleRequest;

class UpdateRoleDto
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $childRoles = null,
    ) {}

    public static function fromRequest(UpdateRoleRequest $request, string $id)
    {
        return new self(
            id: $id,
            name: $request->validated('name'),
            childRoles: $request->validated('child_roles') ?? '',
        );
    }
}
