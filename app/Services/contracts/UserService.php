<?php

namespace App\Services\Contracts;

use App\DTOs\Users\ChangeUserRoleDto;
use App\DTOs\Users\ChangeUserStatusDto;
use App\DTOs\Users\CreateUserDto;
use App\DTOs\Users\UpdateUserDto;

interface UserService
{
    public function create(CreateUserDto $dto);

    public function update(UpdateUserDto $dto);

    public function getUserById(string $id);

    public function resetPassword(string $id);

    public function changeStatus(ChangeUserStatusDto $dto);

    public function changeRole(ChangeUserRoleDto $dto);

    public function countUsers(): int;
}
