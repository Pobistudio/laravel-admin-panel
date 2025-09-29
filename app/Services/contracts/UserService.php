<?php

namespace App\Services\Contracts;

interface UserService
{
    public function create();

    public function update();

    public function delete();

    public function getAll();

    public function getUserById(string $id);

    public function getUsersByRole();

    public function assignRole();

    public function changeStatus();
}
