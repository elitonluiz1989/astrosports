<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * @var UsersRepository
     */
    private $repo;

    public function __construct(UsersRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Retrieve the authenticated user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return Auth::user();
    }

    /**
     * Retrieve all users
     *
     * @return array
     */
    public function users()
    {
        $users = $this->repo->get()->toArray();

        return $users;
    }
}
