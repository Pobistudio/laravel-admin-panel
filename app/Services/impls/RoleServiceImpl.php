<?php

namespace App\Services\impls;

use App\DTOs\Roles\CreateRoleDto;
use App\DTOs\Roles\UpdateRoleDto;
use App\Exceptions\ServiceException;
use App\Models\Role;
use App\Services\Contracts\RoleService;
use App\Utils\MappingUtils;
use App\Utils\SessionUtils;

class RoleServiceImpl implements RoleService
{
    /**
     * Create a new role.
     *
     * @param CreateRoleDto $dto
     * @return Role
     * @throws ServiceException
     */
    public function create(CreateRoleDto $dto)
    {
        $id = str_replace(' ', '_', strtolower($dto->name));
        $role = Role::find($id);

        if ($role) {
            throw new ServiceException("Role with name {$dto->name} already exists");
        }

        //child roles to string
        $childRoles = '';

        if (!empty($dto->childRoles)) {
            $childRoles = implode(',', $dto->childRoles);
        }

        $role = Role::create([
            'id' => $id,
            'name' => $dto->name,
            'child_roles' => $childRoles,
        ]);

        if (!$role) {
            throw new ServiceException("Failed to create role");
        }
        return $role;
    }

    /**
     * Update an existing role.
     *
     * @param UpdateRoleDto $dto
     * @param string $id
     * @return bool
     */
    public function update(UpdateRoleDto $dto)
    {
        $roleWithId = Role::find($dto->id);
        if (!$roleWithId) {
            throw new ServiceException("Role with id {$dto->id} not found");
        }

        $newId = str_replace(' ', '_', strtolower($dto->name));

        if ($newId != $dto->id) {
            $roleWithName = Role::find($newId);

            if ($roleWithName) {
                throw new ServiceException("Role with name {$dto->name} already exists");
            }
        }

        //child roles to string
        $childRoles = '';

        if (!empty($dto->childRoles)) {
            $childRoles = implode(',', $dto->childRoles);
        }

        $roleWithId->id = $newId;
        $roleWithId->name = $dto->name;
        $roleWithId->child_roles = $childRoles;
        return $roleWithId->save();
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
        $role = Role::find($id);
        if (!$role) {
            throw new ServiceException("Role with id {$id} not found");
        }
        $role->is_active = $isActive;
        return $role->save();
    }

    /**
     * Get all roles, excluding specified exceptions.
     *
     * @param array $exceptions
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(array $exceptions = [], int $isActive = 2)
    {
        if ($isActive == 2) {
            return Role::whereNotIn('id', $exceptions)->get();
        } else {
            return Role::whereNotIn('id', $exceptions)->where('is_active', $isActive)->get();
        }
    }

    /**
     * Get a role by its ID.
     *
     * @param string $id
     * @return Role|null
     */
    public function getRoleById(string $id)
    {
        return Role::where('id', $id)->first();
    }

    /**
     * Get child roles from the current session.
     *
     * @return array
     */
    public function getChildRoles()
    {
        return explode(',', SessionUtils::get('child_roles'));
    }

    /**
     * Get roles for select input.
     *
     * @param bool $allItem
     * @param array $exceptions
     * @return array
     */
    public function getRolesDataSelect($allItem = true, array $exceptions = [])
    {
        $roles = $this->getAll($exceptions, 1)->toArray();

        if ($allItem) {
            array_unshift($roles, ['id' => 'all', 'name' => 'All']);
        }

        return MappingUtils::mapToValueLabel($roles, 'id', 'name');
    }

    /**
     * Get child roles for select input.
     *
     * @param bool $allItem
     * @param array $exceptions
     * @return array
     */
    public function getChildRolesDataSelect($allItem = true, array $exceptions = [])
    {
        $childRoles = $this->getChildRoles();

        if (!empty($exceptions)) {
            $childRoles = array_diff($childRoles, $exceptions);
        }

        return MappingUtils::childRolesToValueLabel($childRoles, $allItem);
    }

    public function assignPermissionsToRole()
    {

    }

    public function attachMenuToRole()
    {

    }
}
