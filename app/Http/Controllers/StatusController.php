<?php

namespace App\Http\Controllers;

use App\DataTables\StatusDataTable;
use App\DTOs\Statuses\CreateStatusDto;
use App\DTOs\Statuses\UpdateStatusDto;
use App\Exceptions\ServiceException;
use App\Http\Requests\Statuses\CreateStatusRequest;
use App\Http\Requests\Statuses\UpdateStatusRequest;
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

    public function edit(string $id)
    {
        try {
            $response = $this->statusService->getStatusById($id);

            if (!$response) {
                return redirect()->back()->with('alert', ['type' => 'warning', 'message' => 'Status not found']);
            }
            return view('pages.settings.statuses.edit', compact('response'));
        } catch(ServiceException $e) {
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function update(UpdateStatusRequest $request, string $id)
    {
        try {
            $response = $this->statusService->update(UpdateStatusDto::fromRequest($request, $id));

            $alertSuccess = ['type' => 'success', 'message' => 'Success update status'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed update status'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('statuses')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error update status attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function delete(string $id)
    {
        try {
            $response = $this->statusService->delete($id);

            $alertSuccess = ['type' => 'success', 'message' => 'Success delete status'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed delete status'];

            if (!$response) {
                return redirect()->back()->with('alert', $alertWarning);
            }
            return redirect()->route('statuses')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error delete status attempt : {$e->getMessage()}");
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }
}
