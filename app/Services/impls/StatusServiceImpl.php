<?php

namespace App\Services\impls;

use App\Models\Status;
use App\Services\Contracts\StatusService;
use App\Utils\MappingUtils;

class StatusServiceImpl implements StatusService
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
        return Status::all();
    }

    public function getStatusById(string $id)
    {
        return Status::find($id);
    }

    public function getStatusesDataSelect()
    {
        $statuses = Status::all()->toArray();
        return MappingUtils::mapToValueLabel($statuses, 'id', 'name', [ 'value' => 'all', 'label' => 'Semua Status' ]);

    }
}
