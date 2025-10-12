<?php

namespace App\Services\Contracts;

use App\DTOs\Statuses\CreateStatusDto;
use App\DTOs\Statuses\UpdateStatusDto;

interface StatusService
{
    public function create(CreateStatusDto $dto);

    public function update(UpdateStatusDto $dto);

    public function delete();

    public function getAll();

    public function getStatusById(string $id);

    public function getStatusesDataSelect($allItem = true, $exceptions = []);
}
