<?php

namespace App\Http\Controllers;

use App\DataTables\IconDataTable;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public function index(IconDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.icons.list');
    }
}
