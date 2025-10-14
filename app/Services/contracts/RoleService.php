<?php

namespace App\Services\Contracts;

use App\DTOs\Roles\CreateRoleDto;
use App\DTOs\Roles\UpdateRoleDto;

interface RoleService
{
    public function create(CreateRoleDto $dto);

    public function update(UpdateRoleDto $dto);

    public function delete(string $id);

    public function getAll(array $exceptions = []);

    public function getRoleById(string $id);

    public function getChildRoles();

    public function getRolesDataSelect($allItem = true, array $exceptions = []);

    public function getChildRolesDataSelect($allItem = true, array $exceptions = []);

    public function assignPermissionsToRole();

    public function attachMenuToRole();

}
