<?php

namespace App\Services\impls;

use App\Models\Role;
use App\Services\Contracts\RoleService;

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

    public function getRoleById()
    {

    }

    public function assignPermissionsToRole()
    {

    }

    public function attachMenuToRole()
    {

    }
}
