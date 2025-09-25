<?php

namespace App\Services\Contracts;

interface StatusService
{
    public function create();

    public function update();

    public function delete();

    public function getAll();

    public function getStatusById(string $id);
}
