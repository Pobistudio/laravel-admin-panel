<?php

namespace App\DTOs\Auth;

class ChangePasswordDto
{
    public function __construct(
        public string $oldPassword,
        public string $newPassword,
        public string $newPasswordConfirmation,
    ) {}
}
