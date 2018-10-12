<?php

namespace App\Http\Controllers\Auth;

use App\Events\OnShowLogin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        event(new OnShowLogin());

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

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return response()->json(['login' => true], 200);
        } else {
            return response()->json(['login' => false], 401);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
        //return response()->json(['logout' => true], 200);
    }
}
