<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user()
    {
        $user =  Auth::user();

        return response()->json($user, 200);
    }
}
