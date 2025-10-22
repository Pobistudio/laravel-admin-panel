<?php

namespace App\Http\Controllers;

use App\DataTables\MenuDataTable;
use App\Exceptions\ServiceException;
use App\Services\Contracts\MenuService;
use App\Utils\MappingUtils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    private MenuService $menuService;

    public function __construct(MenuService $menuService) {
        $this->menuService = $menuService;
    }

    public function index(MenuDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.menus.list');
    }

    public function create()
    {
        try {
            $menus = $this->menuService->getAllParent();
            $menus = MappingUtils::mapToValueLabel($menus, 'id', 'name', [ 'value' => '#', 'label' => 'Default Parent' ]);
            return view('pages.settings.menus.create', compact('menus'));
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error change role attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }
}
