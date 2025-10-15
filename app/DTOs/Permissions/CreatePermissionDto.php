<?php

namespace App\DTOs\Permissions;

use App\Http\Requests\Permissions\CreatePermissionRequest;

class CreatePermissionDto
{
    public function __construct(
        public string $name,
    ) {}

    public static function fromRequest(CreatePermissionRequest $request)
    {
        return new self(
            name: $request->validated('name'),
        );
    }
}
