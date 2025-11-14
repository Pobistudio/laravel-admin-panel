<?php

namespace App\Services\impls;

use App\DTOs\Menus\AssignMenuPermissionDto;
use App\Exceptions\ServiceException;
use App\Models\RoleMenuPermission;
use App\Services\contracts\AssignMenuPermissionsService;
use App\Utils\CacheUtils;
use Illuminate\Support\Facades\DB;

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

    /**
     * Assign menu permissions to a role.
     *
     * @param string $roleId
     * @param array $mappings
     * @return bool
     * @throws ServiceException
     */
    public function assignMenuPermissionsToRole(AssignMenuPermissionDto $dto)
    {

        $roleId   = $dto->role;
        $mappings = $dto->mappings;

        // Validate role ID
        if (empty($roleId)) {
            throw new ServiceException("Role ID cannot be empty");
        }

        // Begin transaction
        DB::beginTransaction();
        try {
            // Delete existing permissions for the role
            RoleMenuPermission::where('role_id', $roleId)->delete();
            // Insert new permissions
            foreach ($mappings as $permission) {
                $mappingSplit = explode('-', $permission);
                RoleMenuPermission::create([
                    'role_id' => $roleId,
                    'menu_id' => $mappingSplit[0],
                    'permission_id' => $mappingSplit[1],
                ]);
            }
            // Commit transaction
            DB::commit();
            // Clear cache for menus related to the role
            CacheUtils::deleteWithTags($roleId);
            return true;
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            throw new ServiceException("Failed to assign menu permissions: " . $e->getMessage());
        }
    }
}
