<?php

namespace App\Services\contracts;

use App\DTOs\Auth\ChangePasswordDto;
use App\DTOs\Auth\LoginDto;
use App\Models\User;

interface AuthService
{
    public function login(LoginDto $dto): User|null;
    public function changePassword(ChangePasswordDto $dto): bool|null;
    public function logout();
}
