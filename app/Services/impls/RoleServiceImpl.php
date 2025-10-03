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

    public function getChildRolesDataSelect($allItem = true)
    {
        $childRoles = $this->getChildRoles();
        return MappingUtils::childRolesToValueLabel($childRoles, $allItem);
    }

    public function assignPermissionsToRole()
    {

    }

    public function attachMenuToRole()
    {

    }
}
