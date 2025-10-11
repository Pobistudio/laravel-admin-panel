<?php

namespace App\Http\Controllers;

use App\Services\contracts\DashboardService;

class DashboardController extends Controller
{
    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService) {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $dashboardData = $this->dashboardService->getDashboard();
        return view('pages.dashboard', compact('dashboardData'));
    }
}
