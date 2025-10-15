<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\DTOs\Permissions\CreatePermissionDto;
use App\DTOs\Permissions\UpdatePermissionDto;
use App\Exceptions\ServiceException;
use App\Http\Requests\Permissions\CreatePermissionRequest;
use App\Http\Requests\Permissions\UpdatePermissionRequest;
use App\Services\Contracts\PermissionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    private PermissionService $permissionService;

    public function __construct(PermissionService $permissionService) {
        $this->permissionService = $permissionService;
    }

    public function index(PermissionDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.permissions.list');
    }

    public function create()
    {
        return view('pages.settings.permissions.create');
    }

    public function store(CreatePermissionRequest $request)
    {
        try {
            $response = $this->permissionService->create(CreatePermissionDto::fromRequest($request));

            $alertSuccess = ['type' => 'success', 'message' => 'Success create new permission'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed create new permission'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('statuses')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error create permission attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function edit(string $id)
    {
        try {
            $response = $this->permissionService->getPermissionById($id);

            if (!$response) {
                return redirect()->back()->with('alert', ['type' => 'warning', 'message' => 'Permission not found']);
            }
            return view('pages.settings.permissions.edit', compact('response'));
        } catch(ServiceException $e) {
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error edit permission attempt : {$e->getMessage()}");
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function update(UpdatePermissionRequest $request, string $id)
    {
        try {
            $response = $this->permissionService->update(UpdatePermissionDto::fromRequest($request, $id));

            $alertSuccess = ['type' => 'success', 'message' => 'Success update permission'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed update permission'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('permissions')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error update permission attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function delete(string $id)
    {
        try {
            $response = $this->permissionService->delete($id);

            $alertSuccess = ['type' => 'success', 'message' => 'Success delete permission'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed delete permission'];

            if (!$response) {
                return redirect()->back()->with('alert', $alertWarning);
            }
            return redirect()->route('permissions')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error delete permission attempt : {$e->getMessage()}");
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }
}
