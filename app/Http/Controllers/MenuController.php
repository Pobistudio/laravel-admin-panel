<?php

namespace App\Http\Controllers;

use App\DataTables\MenuDataTable;
use App\DTOs\Menus\CreateMenuDto;
use App\Exceptions\ServiceException;
use App\Http\Requests\Menus\CreateMenuRequest;
use App\Services\Contracts\IconService;
use App\Services\Contracts\MenuService;
use App\Utils\MappingUtils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    private MenuService $menuService;
    private IconService $iconService;

    public function __construct(MenuService $menuService, IconService $iconService) {
        $this->menuService = $menuService;
        $this->iconService = $iconService;
    }

    public function index(MenuDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.menus.list');
    }

    public function create()
    {
        try {
            $menus = $this->menuService->getAllParentDataSelect(true);
            $icons = $this->iconService->getIconsDataSelect(false);
            return view('pages.settings.menus.create', compact('menus', 'icons'));
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error change menu attempt : {$e}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function store(CreateMenuRequest $request)
    {
        try {
            $response = $this->menuService->create(CreateMenuDto::fromRequest($request));

            $alertSuccess = ['type' => 'success', 'message' => 'Success create new menu'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed create new menu'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('menus')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error create menu attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }
}
