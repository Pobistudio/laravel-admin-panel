<?php

namespace App\Services\impls;

use App\Models\Role;
use App\Services\Contracts\RoleService;
use App\Utils\MappingUtils;
use App\Utils\SessionUtils;

class RoleServiceImpl implements RoleService
{
    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function getAll(array $exceptions = [])
    {
        return Role::whereNotIn('id', $exceptions)->get();
    }

    public function getRoleById(string $id)
    {
        return Role::where('id', $id)->first();
    }

    public function getChildRoles()
    {
        return explode(',', SessionUtils::get('child_roles'));
    }

    public function getRolesDataSelect($allItem = true, array $exceptions = [])
    {
        $roles = $this->getAll($exceptions)->toArray();

        if ($allItem) {
            array_unshift($roles, ['id' => 'all', 'name' => 'All']);
        }

        return MappingUtils::mapToValueLabel($roles, 'id', 'name');
    }

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
