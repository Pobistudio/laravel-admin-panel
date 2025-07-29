<?php

namespace App\Services\contracts;

use App\DTOs\Auth\ChangePasswordDto;
use App\DTOs\Auth\LoginDto;
use App\DTOs\Auth\RegisterUserDto;
use App\Models\User;

interface AuthService
{
    public function login(LoginDto $dto): User|null;
    public function registerUser(RegisterUserDto $dto);
    public function changePassword(ChangePasswordDto $dto): bool|null;
    public function logout();
}
