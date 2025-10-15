<?php

namespace App\Http\Controllers;

use App\DataTables\MenuDataTable;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(MenuDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.menus.list');
    }
}
