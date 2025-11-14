<?php

namespace App\Services\Contracts;

use App\DTOs\Permissions\CreatePermissionDto;
use App\DTOs\Permissions\UpdatePermissionDto;

interface PermissionService
{
    public function create(CreatePermissionDto $dto);

    public function update(UpdatePermissionDto $dto);

    public function changeStatus(string $id, bool $isActive);

    public function getAll();
    public function getPermissionById(string $id);

}
