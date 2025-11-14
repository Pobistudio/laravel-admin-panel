<?php

namespace App\Services\contracts;

interface AssignMenuPermissionsService
{
    public function getMenuPermissionsByRole(string $roleId);
}
