<?php

namespace App\DTOs\Auth;

class RegisterUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $roleId = null,
        public ?string $statusId = null,
    ) {}
}
