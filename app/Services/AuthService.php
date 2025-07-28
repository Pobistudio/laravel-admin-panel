<?php

namespace App\Services;

use App\DTOs\Auth\ChangePasswordDto;
use App\DTOs\Auth\LoginDto;
use App\DTOs\Auth\RegisterUserDto;
use App\DTOs\Auth\ResetPasswordDto;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected UserService $userService;
    protected MenuService $menuService;

    public function __construct(UserService $userService, MenuService $menuService)
    {
        $this->userService = $userService;
        $this->menuService = $menuService;
    }

    /**
     * Authenticate a user by email and password.
     *
     * @param LoginDto $dto
     * @return User
     * @throws ValidationException
     */
    public function login(LoginDto $dto): User
    {
        $user = User::where('email', $dto->email)->first();

        if (!$user || !Hash::check($dto->password, $user->password)) {
            Log::warning("Failed login attempt for email: {$dto->email}");
            throw ValidationException::withMessages([
                'email' => ['Email tidak sesuai'],
            ])->status(401);
        }

        if ($user->status_id !== 'active') { // Asumsi 'active' adalah status untuk user aktif
            Log::warning("Login attempt by inactive user: {$dto->email} (Status: {$user->status_id})");
            throw ValidationException::withMessages([
                'email' => ['Akun Anda tidak aktif. Silakan hubungi administrator.'],
            ])->status(403); // 403 Forbidden
        }

        Log::info("User logged in: {$user->email}");
        return $user;
    }

     /**
     * Change user's password.
     *
     * @param User $user
     * @param ChangePasswordDto $dto
     * @return bool
     * @throws ValidationException
     */
    public function changePassword(User $user, ChangePasswordDto $dto)
    {
        if (!Hash::check($dto->oldPassword, $user->password)) {
            Log::warning("Failed password change attempt for user: {$user->email} (old password mismatch)");
            throw ValidationException::withMessages([
                'old_password' => ['Kata sandi lama tidak cocok.'],
            ])->status(400); // 400 Bad Request
        }

        if ($dto->newPassword !== $dto->newPasswordConfirmation) {
            Log::warning("Failed password change attempt for user: {$user->email} (new password confirmation mismatch)");
            throw ValidationException::withMessages([
                'new_password_confirmation' => ['Konfirmasi kata sandi baru tidak cocok.'],
            ])->status(400); // 400 Bad Request
        }

        $user->password = Hash::make($dto->newPassword);
        $saved = $user->save();

        if ($saved) {
            Log::info("Password changed for user: {$user->email}");
            // Optional: Invalidate sessions or tokens if desired
        } else {
            Log::error("Failed to save new password for user: {$user->email}");
        }

        return $saved;
    }

    /**
     * Log out the current user.
     *
     * @param User|null $user If provided, logs out that specific user's sessions/tokens.
     * If null, logs out the currently authenticated user.
     * @return void
     */
    public function logout(?User $user = null)
    {

    }
}
