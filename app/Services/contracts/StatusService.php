<?php

namespace App\Services\Contracts;

use App\DTOs\Statuses\CreateStatusDto;

interface StatusService
{
    public function create(CreateStatusDto $dto);

    public function update();

    public function delete();

    public function getAll();

    public function getStatusById(string $id);

    public function getStatusesDataSelect($allItem = true, $exceptions = []);
}
