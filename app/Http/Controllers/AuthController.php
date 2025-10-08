<?php

namespace App\Http\Controllers;

use App\DTOs\Auths\ChangePasswordDto;
use App\DTOs\Auths\LoginDto;
use App\Exceptions\ServiceException;
use App\Http\Requests\Auths\ChangePasswordRequest;
use App\Http\Requests\Auths\LoginRequest;
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
            $result = $this->authService->login(LoginDto::fromRequest($request));
            $alertSuccess = ['type' => 'success', 'message' => 'Success login user'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed login user'];
            if ($result) {
                return redirect()->route('dashboard')->with('alert', $alertSuccess);
            }
            return redirect()->back()->withInput()->with('alert', $alertWarning);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Error login user attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function forgotPassword()
    {
        return view('pages.auths.forgot-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $result = $this->authService->changePassword(ChangePasswordDto::fromRequest($request));
            $alertSuccess = ['type' => 'success', 'message' => 'Success change password'];
            $alertWarning = ['type' => 'warning', 'message' => 'Failed change password'];
            return redirect()->back()->withInput()->with('alert', $result ? $alertSuccess : $alertWarning);
        } catch(ServiceException $e) {
            return redirect()->back()->withInput()->with('alert', ['type' => 'warning', 'message' => $e->getMessage()]);
        } catch(Exception $e) {
            Log::error("Failed change password user attempt : {$e->getMessage()}");
            return redirect()->back()->withInput()->with('alert', ['type' => 'error', 'message' => 'Internal Server Error']);
        }
    }

    public function doLogout()
    {
        $this->authService->logout();
        return redirect()->route('login');
    }
}
