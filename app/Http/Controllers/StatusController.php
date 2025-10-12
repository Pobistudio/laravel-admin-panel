<?php

namespace App\Http\Controllers;

use App\DataTables\StatusDataTable;
use App\DTOs\Statuses\CreateStatusDto;
use App\Exceptions\ServiceException;
use App\Http\Requests\Statuses\CreateStatusRequest;
use App\Services\Contracts\StatusService;
use Exception;
use Illuminate\Support\Facades\Log;

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

    public function create()
    {
        return view('pages.settings.statuses.create');
    }

    public function store(CreateStatusRequest $request)
    {
        try {
            $response = $this->statusService->create(CreateStatusDto::fromRequest($request));

            $alertSuccess = ['type' => 'success', 'message' => 'Success create new status'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed create new status'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('statuses')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error create status attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }
}
