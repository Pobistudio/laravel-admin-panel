<?php

namespace App\DTOs\Permissions;

use App\Http\Requests\Permissions\UpdatePermissionRequest;

class UpdatePermissionDto
{
    public function __construct(
        public string $id,
        public string $name,
    ) {}

    public static function fromRequest(UpdatePermissionRequest $request, string $id)
    {
        return new self(
            id: $id,
            name: $request->validated('name'),
        );
    }
}
