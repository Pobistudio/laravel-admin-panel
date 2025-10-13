<?php

namespace App\Http\Requests\Roles;

class CreateRoleDto
{
    public function __construct(
        public string $name,
        public string $childRoles,
    ) {}

    public static function fromRequest(CreateRoleRequest $request)
    {
        return new self(
            name: $request->validated('name'),
            childRoles: $request->validated('child_roles'),
        );
    }
}
