<?php

namespace App\Services\impls;

use App\DTOs\Statuses\CreateStatusDto;
use App\DTOs\Statuses\UpdateStatusDto;
use App\Exceptions\ServiceException;
use App\Models\Status;
use App\Services\Contracts\StatusService;
use App\Utils\MappingUtils;

class StatusServiceImpl implements StatusService
{
    /**
     * Create a new status.
     *
     * @param CreateStatusDto $dto
     * @return Status
     * @throws ServiceException
     */
    public function create(CreateStatusDto $dto)
    {
        $id = str_replace(' ', '_', strtolower($dto->name));
        $status = Status::find($id);

        if ($status) {
            throw new ServiceException("Status with name {$dto->name} already exists");
        }

        $status = Status::create([
            'id' => $id,
            'name' => $dto->name,
        ]);

        if (!$status) {
            throw new ServiceException("Failed to create status");
        }
        return $status;
    }

    /**
     * Update an existing status.
     *
     * @param UpdateStatusDto $dto
     * @param string $id
     * @return bool
     */
    public function update(UpdateStatusDto $dto)
    {
        $statusWithId = Status::find($dto->id);
        if (!$statusWithId) {
            throw new ServiceException("Status with id {$dto->id} not found");
        }

        $newId = str_replace(' ', '_', strtolower($dto->name));
        $statusWithName = Status::find($newId);

        if ($statusWithName) {
            throw new ServiceException("Status with name {$dto->name} already exists");
        }

        $statusWithId->id = $newId;
        $statusWithId->name = $dto->name;
        return $statusWithId->save();
    }

    public function delete()
    {

    }

    public function getAll()
    {
        return Status::all();
    }

    /**
     * Get a status by its ID.
     *
     * @param string $id
     * @return Status|null
     */
    public function getStatusById(string $id)
    {
        return Status::find($id);
    }

    /**
     * Get statuses for select input.
     *
     * @param bool $allItem
     * @param array $exceptions
     * @return array
     */
    public function getStatusesDataSelect($allItem = true, $exceptions = [])
    {
        $statuses = Status::whereNotIn('id', $exceptions)->get()->toArray();
        if ($allItem) {
            return MappingUtils::mapToValueLabel($statuses, 'id', 'name', [ 'value' => 'all', 'label' => 'Semua Status' ]);
        }
        return MappingUtils::mapToValueLabel($statuses, 'id', 'name');

    }
}
