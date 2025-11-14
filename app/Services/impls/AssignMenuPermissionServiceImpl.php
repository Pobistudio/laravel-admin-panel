<?php

namespace App\Services\impls;

use App\Exceptions\ServiceException;
use App\Models\RoleMenuPermission;
use App\Services\contracts\AssignMenuPermissionsService;

class AssignMenuPermissionServiceImpl implements AssignMenuPermissionsService
{
    /**
     * Get menu permissions by role ID.
     *
     * @param string $roleId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ServiceException
     */
    public function getMenuPermissionsByRole(string $roleId)
    {
        if (empty($roleId)) {
            throw new ServiceException("Role ID cannot be empty");
        }

        return RoleMenuPermission::with('menu')->with('permission')->where('role_id', $roleId)->get();
    }
}
