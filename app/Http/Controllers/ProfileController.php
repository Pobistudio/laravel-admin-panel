<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserService;
use App\Utils\SessionUtils;

class ProfileController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index()
    {
        $name = SessionUtils::get('name');
        $user = $this->userService->getUserById(SessionUtils::get('id'));
        return view('pages.profile', compact('name', 'user'));
    }
}
