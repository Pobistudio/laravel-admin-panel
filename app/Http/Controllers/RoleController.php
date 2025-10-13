<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Services\Contracts\RoleService;
use Illuminate\Http\Request;

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
}
