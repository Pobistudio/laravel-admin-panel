<?php

namespace App\Services\impls;

use App\Services\contracts\DashboardService;
use App\Services\Contracts\UserService;

class DashboardServiceImpl implements DashboardService
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Get dashboard data.
     *
     * @return array
     */
    public function getDashboard(): array
    {
        return [
            [
                "title" => "Total Users",
                "value" => $this->userService->countUsers(),
                "color" => "bg-white"
            ]
        ];
    }
}
