<?php

namespace App\Services\Contracts;

interface RoleService
{
    public function create();

    public function update();

    public function delete();

    public function getAll(array $exceptions = []);

    public function getRoleById(string $id);

    public function getChildRoles();

    public function getChildRolesDataSelect($allItem = true);

    public function assignPermissionsToRole();

    public function attachMenuToRole();

}
