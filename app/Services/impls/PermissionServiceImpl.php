<?php

namespace App\Services\impls;

use App\DTOs\Permissions\CreatePermissionDto;
use App\DTOs\Permissions\UpdatePermissionDto;
use App\Exceptions\ServiceException;
use App\Models\Permission;
use App\Services\Contracts\PermissionService;

class PermissionServiceImpl implements PermissionService
{
    /**
     * Create a new permission.
     *
     * @param CreatePermissionDto $dto
     * @return Permission
     * @throws ServiceException
     */
    public function create(CreatePermissionDto $dto)
    {
        $id = str_replace(' ', '_', strtolower($dto->name));
        $status = Permission::find($id);

        if ($status) {
            throw new ServiceException("Permission with name {$dto->name} already exists");
        }

        $status = Permission::create([
            'id' => $id,
            'name' => $dto->name,
        ]);

        if (!$status) {
            throw new ServiceException("Failed to create permission");
        }
        return $status;
    }

    /**
     * Update an existing permission.
     *
     * @param UpdatePermissionDto $dto
     * @param string $id
     * @return bool
     */
    public function update(UpdatePermissionDto $dto)
    {
        $permissionWithId = Permission::find($dto->id);
        if (!$permissionWithId) {
            throw new ServiceException("Permission with id {$dto->id} not found");
        }

        $newId = str_replace(' ', '_', strtolower($dto->name));

        if ($newId != $dto->id) {
            $permissionWithName = Permission::find($newId);

            if ($permissionWithName) {
                throw new ServiceException("Permission with name {$dto->name} already exists");
            }
        }

        $permissionWithId->id = $newId;
        $permissionWithId->name = $dto->name;
        return $permissionWithId->save();
    }

    /**
     * Summary of changeStatus
     * @param string $id
     * @param bool $isActive
     * @throws \App\Exceptions\ServiceException
     * @return bool
     */
    public function changeStatus(string $id, bool $isActive)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            throw new ServiceException("Permission with id {$id} not found");
        }
        $permission->is_active = $isActive;
        return $permission->save();
    }

    /**
     * Get a permission by its ID.
     *
     * @param string $id
     * @return Permission|null
     */
    public function getPermissionById(string $id)
    {
        return Permission::where('id', $id)->first();
    }
}
