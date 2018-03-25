<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var UsersRepository
     */
    private $repo;

    public function __construct(UsersRepository $repo)
    {
        $this->repo = $repo;
    }

    public function user()
    {
        $user =  Auth::user();

        return response()->json($user, 200);
    }

    public function users()
    {
        try {
            $users = $this->repo->get()->toArray();

          return response()->json($users['data']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
