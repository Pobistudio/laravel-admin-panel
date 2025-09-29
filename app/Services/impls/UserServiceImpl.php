<?php

namespace App\Services\impls;

use App\Models\User;
use App\Services\Contracts\UserService;

class UserServiceImpl implements UserService
{
    public function create()
    {

    }

    public function update()
    {

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
