<?php

namespace App\DTOs\Auth;

use App\Http\Requests\auths\ChangePasswordRequest;

class ChangePasswordDto
{
    public function __construct(
        public string $email,
        public string $newPassword,
        public string $newPasswordConfirmation,
    ) {}

    public static function fromRequest(ChangePasswordRequest $request)
    {
        return new self(
            email: $request->validated('email'),
            newPassword: $request->validated('new_password'),
            newPasswordConfirmation: $request->validated('confirm_password'),
        );
    }
}
