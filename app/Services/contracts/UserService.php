<?php

namespace App\Services\Contracts;

use App\DTOs\Auth\CreateUserDto;
use App\DTOs\Auth\UpdateUserDto;

interface UserService
{
    public function create(CreateUserDto $dto);

    public function update(UpdateUserDto $dto);

    public function delete();

    public function getAll();

    public function getUserById(string $id);

    public function getUsersByRole();

    public function assignRole();

    public function changeStatus();
}
