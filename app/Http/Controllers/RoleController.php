<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\DTOs\Roles\CreateRoleDto;
use App\Exceptions\ServiceException;
use App\Http\Requests\Roles\CreateRoleRequest;
use App\Services\Contracts\RoleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }

    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.roles.list');
    }

    public function create()
    {
        $roles = $this->roleService->getRolesDataSelect(false);
        return view('pages.settings.roles.create', compact('roles'));
    }

    public function store(CreateRoleRequest $request)
    {
        try {
            $response = $this->roleService->create(CreateRoleDto::fromRequest($request));

            $alertSuccess = ['type' => 'success', 'message' => 'Success create new role'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed create new role'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('roles')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error create role attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }
}
