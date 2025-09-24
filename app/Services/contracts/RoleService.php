<?php

namespace App\Services\Contracts;

interface RoleService
{
    public function create();

    public function update();

    public function delete();

    public function getAll(array $exceptions = []);

    public function getRoleById();

    public function assignPermissionsToRole();

    public function attachMenuToRole();
}
