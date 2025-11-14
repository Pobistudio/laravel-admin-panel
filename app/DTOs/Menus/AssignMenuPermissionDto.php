<?php

namespace App\DTOs\Menus;

use App\Http\Requests\Menus\AssignMenuPermissionsRequest;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Mappings;

class AssignMenuPermissionDto
{
    public function __construct(
        public readonly string $role,
        public readonly array $mappings,
    ) {
    }

    public static function fromRequest(AssignMenuPermissionsRequest $request)
    {
        return new self(
            role: $request->validated('role'),
            mappings: $request->validated('mappings'),
        );
    }
}
