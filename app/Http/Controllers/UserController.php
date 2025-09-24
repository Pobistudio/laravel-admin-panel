<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Utils\SessionUtils;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Services\Contracts\RoleService;
use App\Utils\MappingUtils;

class UserController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $startDate = $request->post() && $request->has('start_date') && !empty($request->get('start_date')) ? $request->get('start_date') : Carbon::now()->format('Y-m-d');
        $endDate   = $request->post() && $request->has('end_date') && !empty($request->get('end_date')) ? $request->get('end_date') : Carbon::now()->addDays(30)->format('Y-m-d');
        $status    = $request->post() && $request->has('status') && !empty($request->get('status')) ? $request->get('status') : 'all';
        $role      = $request->post() && $request->has('role') && !empty($request->get('role')) ? $request->get('role') : 'all';
        $roles     = $this->roleService->getAll([SessionUtils::get('role')])->toArray();
        $listRoles = MappingUtils::mapToValueLabel($roles, 'id', 'name', [ 'value' => 'all', 'label' => 'Semua Role' ]);
        $dataTable = new UserDataTable($startDate, $endDate, $status, $role);
        return $dataTable->render('pages.users.list', compact('startDate', 'endDate', 'listRoles'));
    }

    public function create()
    {
        return view('pages.users.create');
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
