<?php

namespace App\Http\Controllers;

use App\DataTables\IconDataTable;
use App\DTOs\Icons\CreateIconDto;
use App\Exceptions\ServiceException;
use App\Http\Requests\Icons\CreateIconRequest;
use App\Services\Contracts\IconService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IconController extends Controller
{
    private IconService $iconService;

    public function __construct(IconService $iconService) {
        $this->iconService = $iconService;
    }

    public function index(IconDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.icons.list');
    }

    public function create()
    {
        $iconTypes = $this->iconService->getIconTypesSelect();
        return view('pages.settings.icons.create', compact('iconTypes'));
    }

    public function store(CreateIconRequest $request)
    {
        try {
            $response = $this->iconService->create(CreateIconDto::fromRequest($request, 'remixicon'));

            $alertSuccess = ['type' => 'success', 'message' => 'Success create new icon'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed create new icon'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('icons')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error create icon attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }


}
