<?php

namespace App\Http\Controllers;

use App\DTOs\Auth\LoginDto;
use App\Http\Requests\auths\LoginRequest;
use App\Services\contracts\AuthService;
use Exception;
use Illuminate\Support\Facades\Log;

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
                return redirect()->route('dashboard')->with('alert', ['type' => 'success', 'message' => 'Success login user']);
            }
            return redirect()->back()->with('alert', ['type' => 'warning', 'message' => 'Failed login']);
        } catch(Exception $e) {
            Log::error("Failed login user attempt : {$e->getMessage()}");
            return redirect()->back()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
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
