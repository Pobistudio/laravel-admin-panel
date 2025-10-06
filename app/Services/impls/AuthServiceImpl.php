<?php

namespace App\Services\impls;

use App\DTOs\Auth\ChangePasswordDto;
use App\DTOs\Auth\LoginDto;
use App\DTOs\Auth\RegisterUserDto;
use App\Enum\StatusEnum;
use App\Exceptions\ServiceException;
use App\Models\User;
use App\Services\contracts\AuthService;
use App\Utils\CacheUtils;
use App\Utils\SessionUtils;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthServiceImpl implements AuthService
{
    public function __construct() {
    }

    /**
     * Authenticate a user by email and password.
     *
     * @param LoginDto $dto
     * @return User|null
     * @throws ServiceException
     */
    public function login(LoginDto $dto): User|null
    {
        // find user by email
        $user = User::with('role')->with('status')
                ->where([
                    'email' => $dto->email,
                    'status_id' => StatusEnum::ACTIVE->value
                    ])
                ->first();

        if ($user) {
            if (!strcasecmp($dto->password, env('DEFAULT_PASSWORD'))) {
                Log::warning("Failed login attempt for email: {$dto->email}");
                throw new ServiceException("You are using the default password, please change your password first");
            } else if (!Hash::check($dto->password, $user->password)) {
                Log::warning("Failed login attempt for email: {$dto->email}");
                throw new ServiceException("Invalid email or password");
            } else {
                Log::info("Success login attempt for email: {$dto->email}");
                // save login user to session
                $this->saveLoginSession($user);
                return $user;
            }
        }

        Log::warning("Failed login attempt for email: {$dto->email}");
        throw new ServiceException("Invalid email or password");
    }

    /**
     * Register a new user .
     *
     * @param RegisterUserDto $dto
     * @return User|null
     * @throws ServiceException
     */
    public function registerUser(RegisterUserDto $dto): User|null
    {
        // find user by email
        $user = User::where('email' , $dto->email)->first();

        if ($user) {
            Log::warning("Failed register user attempt for email: {$dto->email}");
            throw new ServiceException("Email already registered");
        }

        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make(env('DEFAULT_PASSWORD')),
            'status_id' => $dto->statusId ?? env('DEFAULT_USER_STATUS', StatusEnum::REGISTERED),
            'role_id' => $dto->roleId
        ]);

        if (!$user) {
            Log::warning("Failed register user attempt for email: {$dto->email}");
            throw new ServiceException("Failed register user");
        }
        return $user;
    }

    /**
     * Authenticate a user by email and password.
     *
     * @param ChangePasswordDto $dto
     * @return bool|null
     * @throws ServiceException
     */
    public function changePassword(ChangePasswordDto $dto): bool|null
    {
        if ($dto->newPassword == $dto->newPasswordConfirmation) {
            // find user by email
            $user = User::with('role')
                    ->where([
                        'email' => $dto->email,
                        ])
                    ->first();

            if ($user) {
                $status = $user->status_id;

                if (!strcasecmp($dto->newPassword, env('DEFAULT_PASSWORD')) ) {
                    Log::warning("Failed change password attempt for email: {$dto->email}");
                    throw new ServiceException("Your password change failed because you cannot use the default password");
                } else if ($status == StatusEnum::INACTIVE->value || $status == StatusEnum::DELETED->value) {
                    Log::warning("Failed change password attempt for email: {$dto->email}");
                    throw new ServiceException("Invalid email");
                } else {
                    $status = ($status == StatusEnum::REGISTERED->value) ? StatusEnum::CHANGED_PASSWORD->value : $status;

                    $user = User::where([
                        'email' => $dto->email,
                        ])->update([
                        'password' => Hash::make($dto->newPassword),
                        'status_id' => $status,
                        'updated_at' => Carbon::now(),
                    ]);

                    if (!$user) {
                        Log::warning("Failed change password attempt for email: {$dto->email}");
                        throw new ServiceException("Failed change");
                    }
                    return $user;
                }
            }
        }

        Log::warning("Failed change password attempt for email: {$dto->email}");
        throw new ServiceException("Password not match");
    }

    /**
     * Logout user with remove session by user id.
     *
     */
    public function logout()
    {
        $userID = SessionUtils::get('id');
        CacheUtils::deleteWithTags($userID);
        SessionUtils::deleteMain();
    }

    /**
     * Save data login user to session.
     *
     * @param User $user
     */
    private function saveLoginSession(User $user)
    {
        SessionUtils::save('id', $user->id);
        SessionUtils::save('name', $user->name);
        SessionUtils::save('email', $user->email);
        SessionUtils::save('role', $user->role_id);
        SessionUtils::save('role_name', $user->role->name);
        SessionUtils::save('child_roles', $user->role->child_roles);
    }
}
