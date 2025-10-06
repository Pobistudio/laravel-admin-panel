<?php

namespace App\Http\Controllers;

use App\Http\Requests\auths\RegisterUserRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\DTOs\Auth\RegisterUserDto;
use App\Enum\StatusEnum;
use App\Exceptions\ServiceException;
use App\Services\contracts\AuthService;
use App\Services\Contracts\RoleService;
use App\Services\Contracts\StatusService;
use App\Services\Contracts\UserService;
use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private RoleService $roleService;
    private StatusService $statusService;
    private UserService $userService;
    private AuthService $authService;

    public function __construct(RoleService $roleService, StatusService $statusService, UserService $userService, AuthService $authService) {
        $this->roleService = $roleService;
        $this->statusService = $statusService;
        $this->userService = $userService;
        $this->authService = $authService;
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

    public function store(RegisterUserRequest $request)
    {
        try {
            $response = $this->authService->registerUser(RegisterUserDto::fromRequest($request, env('DEFAULT_USER_STATUS', StatusEnum::REGISTERED)));

            $alertSuccess = ['type' => 'success', 'message' => 'Success create new user'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed create new user'];

            if ($response) {
                return redirect()->route('users')->with('alert', $alertSuccess);
            }
            return redirect()->back()->withInput()->with('alert', $alertWarning);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
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
