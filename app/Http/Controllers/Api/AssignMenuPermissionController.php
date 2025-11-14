<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\contracts\AssignMenuPermissionsService;
use App\Services\Contracts\MenuService;
use App\Services\Contracts\PermissionService;
use Exception;
use Illuminate\Support\Facades\Log;

class AssignMenuPermissionController extends Controller
{
    private AssignMenuPermissionsService $assignMenuPermissionsService;
    private PermissionService $permissionService;
    private MenuService $menuService;

    public function __construct(AssignMenuPermissionsService $assignMenuPermissionsService, PermissionService $permissionService, MenuService $menuService) {
        $this->assignMenuPermissionsService = $assignMenuPermissionsService;
        $this->permissionService = $permissionService;
        $this->menuService = $menuService;
    }

    public function getMenuPermissionsByRole(string $roleId)
    {
        try {
            $mapping = $this->assignMenuPermissionsService->getMenuPermissionsByRole($roleId);
            $permissions = $this->permissionService->getAll();
            $menus = $this->menuService->getAll();
            $data = [
                'mapping'     => $mapping,
                'permissions' => $permissions,
                'menus'       => $menus,
            ];
            return response()->json(['data' => $data], 200);
        } catch(ServiceException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch(Exception $e) {
            Log::error("Error get menu permissions by role attempt : {$e->getMessage()}");
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
