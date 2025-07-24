<?php

namespace App\DTOs\Auth;

class ResetPasswordDto
{
    public function __construct(
        public string $email,
        public string $password,
        public string $passwordConfirmation,
        public string $token
    ) {}
}
