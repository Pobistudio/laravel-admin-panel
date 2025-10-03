<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Utils\SessionUtils;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Services\Contracts\RoleService;
use App\Services\Contracts\StatusService;
use App\Services\Contracts\UserService;
use App\Utils\MappingUtils;

class UserController extends Controller
{
    private RoleService $roleService;
    private StatusService $statusService;
    private UserService $userService;

    public function __construct(RoleService $roleService, StatusService $statusService, UserService $userService) {
        $this->roleService = $roleService;
        $this->statusService = $statusService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $startDate    = $request->post() && $request->has('start_date') && !empty($request->get('start_date')) ? $request->get('start_date') : Carbon::now()->format('Y-m-d');
        $endDate      = $request->post() && $request->has('end_date') && !empty($request->get('end_date')) ? $request->get('end_date') : Carbon::now()->addDays(30)->format('Y-m-d');
        $status       = $request->post() && $request->has('status') && !empty($request->get('status')) ? $request->get('status') : 'all';
        $role         = $request->post() && $request->has('role') && !empty($request->get('role')) ? $request->get('role') : 'all';
        $listRoles    = $this->roleService->getChildRolesDataSelect();
        $listStatuses = $this->statusService->getStatusesDataSelect();
        $dataTable    = new UserDataTable($startDate, $endDate, $status, $role);
        return $dataTable->render('pages.users.list', compact('startDate', 'endDate', 'role', 'status', 'listRoles', 'listStatuses'));
    }

    public function create()
    {
        $listRoles    = $this->roleService->getChildRolesDataSelect(false);
        return view('pages.users.create', compact('listRoles'));
    }

    public function store()
    {

    }

    public function edit($id)
    {

        return view('pages.users.edit');
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}
