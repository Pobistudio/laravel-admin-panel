<?php

namespace App\Services\Contracts;

use App\DTOs\Permissions\CreatePermissionDto;
use App\DTOs\Permissions\UpdatePermissionDto;

interface PermissionService
{
    public function create(CreatePermissionDto $dto);

    public function update(UpdatePermissionDto $dto);

    public function delete(string $id);

    public function getPermissionById(string $id);

}
