<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // UserDataTable $dataTable
        // return $dataTable->render('pages.users.list');
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store()
    {

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
