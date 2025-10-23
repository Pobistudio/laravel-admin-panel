<?php

namespace App\Http\Controllers;

use App\DataTables\IconDataTable;
use App\DTOs\Icons\CreateIconDto;
use App\DTOs\Icons\UpdateIconDto;
use App\Exceptions\ServiceException;
use App\Http\Requests\Icons\CreateIconRequest;
use App\Http\Requests\Icons\UpdateIconRequest;
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

    public function edit(string $id)
    {
        try {
            $response = $this->iconService->getIconById($id);
            $iconTypes = $this->iconService->getIconTypesSelect();
            $type = substr($response->id, strrpos($response->id, '-') + 1);
            if (!$response) {
                return redirect()->back()->with('alert', ['type' => 'warning', 'message' => 'Icon not found']);
            }
            return view('pages.settings.icons.edit', compact('response', 'iconTypes', 'type'));
        } catch(ServiceException $e) {
            return redirect()->route('icons')->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error edit icon attempt : {$e->getMessage()}");
            return redirect()->route('icons')->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function update(UpdateIconRequest $request, string $id)
    {
        try {
            $response = $this->iconService->update(UpdateIconDto::fromRequest($request, $id));

            $alertSuccess = ['type' => 'success', 'message' => 'Success update icon'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed update icon'];

            if (!$response) {
                return redirect()->back()->withInput()->with('alert', $alertWarning);
            }
            return redirect()->route('icons')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error update icon attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function changeStatus(string $id, bool $status)
    {
        try {
            $response = $this->iconService->changeStatus($id, $status);

            $alertSuccess = ['type' => 'success', 'message' => 'Success change status icon'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed change status icon'];

            if (!$response) {
                return redirect()->back()->with('alert', $alertWarning);
            }
            return redirect()->route('icons')->with('alert', $alertSuccess);
        } catch(ServiceException $e) {
            return redirect()->back()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error delete icon attempt : {$e->getMessage()}");
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

}
