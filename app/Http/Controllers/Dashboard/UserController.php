<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user()
    {
        $user =  Auth::user();

        return response()->json($user, 200);
    }

    public function users()
    {
        try {
          $users = User::with('userRole')->get();

          return response()->json(['users' => $users]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
