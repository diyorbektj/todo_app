<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->authService->register($request);

        return response()->json([
            'status' => true,
            'redirect' => url('dashboard'),
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => true,
                'redirect' => url('dashboard'),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => ['Invalid credentials'],
            ]);
        }
    }

    public function logout(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }
}
