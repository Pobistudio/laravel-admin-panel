<?php

namespace App\Http\Requests\Roles;

class UpdateRoleDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $childRoles,
    ) {}

    public static function fromRequest(UpdateRoleRequest $request, string $id)
    {
        return new self(
            id: $id,
            name: $request->validated('name'),
            childRoles: $request->validated('child_roles'),
        );
    }
}
