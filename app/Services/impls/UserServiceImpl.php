<?php

namespace App\Services\impls;

use App\DTOs\Auth\CreateUserDto;
use App\DTOs\Auth\UpdateUserDto;
use App\Enum\StatusEnum;
use App\Exceptions\ServiceException;
use App\Models\User;
use App\Services\Contracts\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserServiceImpl implements UserService
{
    /**
     * Create a new user .
     *
     * @param CreateUserDto $dto
     * @return User|null
     * @throws ServiceException
     */
    public function create(CreateUserDto $dto): User|null
    {
        // find user by email
        $user = User::where('email' , $dto->email)->first();

        if ($user) {
            Log::warning("Failed create user attempt for email: {$dto->email}");
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
            Log::warning("Failed create user attempt for email: {$dto->email}");
            throw new ServiceException("Failed create user");
        }
        return $user;
    }

     /**
     * Update a user .
     *
     * @param UpdateUserDto $dto
     * @return bool|null
     * @throws ServiceException
     */
    public function update(UpdateUserDto $dto)
    {
        // find user by email
        $user = User::where('id' , $dto->id)->first();

        if (!$user) {
            Log::warning("User not found attempt for id: {$dto->id}");
            throw new ServiceException("User not found");
        }

        $oldEmail = $user->email;

        if ($oldEmail !== $dto->email) {
            $checkEmail = User::where('email', $dto->email)->first();
            if ($checkEmail) {
                Log::warning("Failed update user attempt for email: {$dto->email}");
                throw new ServiceException("Email already registered");
            }
        }

        $updated = User::where('id', $dto->id)->update([
            'name' => $dto->name,
            'email' => $dto->email,
        ]);

        if (!$updated) {
            Log::warning("Failed to update user for id: {$dto->id}");
            throw new ServiceException("Failed to update user");
        }

        // Return the updated user instance
        return $updated;

    }

    public function delete()
    {

    }

    public function getAll()
    {

    }

    public function getUserById(string $id)
    {
        return User::find($id);
    }

    public function getUsersByRole()
    {

    }

    public function assignRole()
    {

    }

    public function changeStatus()
    {

    }
}
