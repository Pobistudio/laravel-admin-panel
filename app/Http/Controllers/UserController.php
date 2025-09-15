<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->post() && $request->has('start_date') && !empty($request->get('start_date')) ? $request->get('start_date') : Carbon::now()->format('Y-m-d');
        $endDate   = $request->post() && $request->has('end_date') && !empty($request->get('start_date')) ? $request->get('start_date') : Carbon::now()->addDays(30)->format('Y-m-d');
        $status    = $request->post() && $request->has('status') && !empty($request->get('status')) ? $request->get('status') : 'all';
        $role      = $request->post() && $request->has('role') && !empty($request->get('role')) ? $request->get('role') : 'all';
        $dataTable = new UserDataTable($startDate, $endDate, $status, $role);
        return $dataTable->render('pages.users.list', compact('startDate', 'endDate'));
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
