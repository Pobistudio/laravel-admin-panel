<?php

namespace App\Http\Controllers;

use App\DTOs\Auth\LoginDto;
use App\Http\Requests\auths\LoginRequest;
use App\Services\contracts\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('pages.auths.login');
    }

    public function doLogin(LoginRequest $request)
    {
        try {

            $user = $this->authService->login(LoginDto::fromRequest($request));

            if ($user) {

            }
        } catch(Exception $e) {

        }
    }

    public function forgotPassword()
    {
        return view('pages.auths.forgot-password');
    }

    public function changePassword()
    {

    }

    public function doLogout()
    {

    }
}
