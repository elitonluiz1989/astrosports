<?php

namespace App\Http\Controllers\Auth;

use App\Events\OnShowLogin;
use Illuminate\Http\Request;
use App\Handlers\LoginHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use LoginHandler;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        $data = [
            'currentPage' => config('dashboard.defaultPage'),
        ];

        return view('dashboard.index', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember = $request->input('remember') ?? false;

        if (!Auth::attempt($credentials, $remember)) {
            return response()->json(['login' => 0], 401);
        }

        return response()->json(['login' => 1]);
    }

    /**
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
