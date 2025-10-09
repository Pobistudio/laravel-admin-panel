<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\DTOs\Users\ChangeUserRoleDto;
use App\DTOs\Users\ChangeUserStatusDto;
use App\DTOs\Users\CreateUserDto;
use App\DTOs\Users\UpdateUserDto;
use App\Enum\StatusEnum;
use App\Exceptions\ServiceException;
use App\Http\Requests\Users\ChangeUserRoleRequest;
use App\Http\Requests\Users\ChangeUserStatusRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
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

    public function store(CreateUserRequest $request)
    {
        try {
            $response = $this->userService->create(CreateUserDto::fromRequest($request, env('DEFAULT_USER_STATUS', StatusEnum::REGISTERED)));

            $alertSuccess = ['type' => 'success', 'message' => 'Success create new user'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed create new user'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('users')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->userService->getUserById($id);

            if (!$response) {
                return redirect()->back()->with('alert', ['type' => 'warning', 'message' => 'User not found']);
            }
            return view('pages.users.edit', compact('response'));
        } catch(ServiceException $e) {
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $response = $this->userService->update(UpdateUserDto::fromRequest($id, $request));

            $alertSuccess = ['type' => 'success', 'message' => 'Success update user'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed update user'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('users')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function resetPassword($id)
    {
        try {
            $response = $this->userService->resetPassword($id);

            if (!$response) {
                return redirect()->route('users')->with('alert', ['type' => 'warning', 'message' => 'User not found']);
            }
            return redirect()->route('users')->with('alert', ['type' => 'success', 'message' => 'Success reset password for user']);
        } catch(ServiceException $e) {
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $response = $this->userService->getUserById($id);

            if (!$response) {
                return redirect()->route('users')->with('alert', ['type' => 'warning', 'message' => 'User not found']);
            }
            $listStatuses = $this->statusService->getStatusesDataSelect(false, [$response->status_id]);
            return view('pages.users.change-status', compact('response', 'listStatuses'));
        } catch(ServiceException $e) {
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function doChangeStatus(ChangeUserStatusRequest $request, $id)
    {
        try {
            $response = $this->userService->changeStatus(ChangeUserStatusDto::fromRequest( $request, $id));

            $alertSuccess = ['type' => 'success', 'message' => 'Success update status user'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed update status user'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('users')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function changeRole($id)
    {
        try {
            $response = $this->userService->getUserById($id);

            if (!$response) {
                return redirect()->route('users')->with('alert', ['type' => 'warning', 'message' => 'User not found']);
            }
            $listRoles = $this->roleService->getRolesDataSelect(false, [$response->role_id]);
            return view('pages.users.change-role', compact('response', 'listRoles'));
        } catch(ServiceException $e) {
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->route('users')->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function doChangeRole(ChangeUserRoleRequest $request, $id)
    {
        try {
            $response = $this->userService->changeRole(ChangeUserRoleDto::fromRequest($request, $id));

            $alertSuccess = ['type' => 'success', 'message' => 'Success update role user'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed update role user'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            // if ($this->authService->getCurrentUser()->id === $id) {
            //     $this->authService->logout();
            //     return redirect()->route('login')->with('alert', ['type' => 'info', 'message' => 'Please login again to apply the new role']);
            // }
            return redirect()->route('users')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error register user attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }
}
