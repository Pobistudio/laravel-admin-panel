<?php

namespace App\Services\contracts;

use App\DTOs\Menus\AssignMenuPermissionDto;

interface AssignMenuPermissionsService
{
    public function getMenuPermissionsByRole(string $roleId);
    public function assignMenuPermissionsToRole(AssignMenuPermissionDto $dto);
}
