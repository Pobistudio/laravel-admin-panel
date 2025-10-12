<?php

namespace App\Http\Controllers;

use App\DataTables\StatusDataTable;
use App\Models\Status;
use App\Services\Contracts\StatusService;

class StatusController extends Controller
{
    private StatusService $statusService;

    public function __construct(StatusService $statusService) {
        $this->statusService = $statusService;
    }

    public function index(StatusDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.statuses.list');
    }
}
