<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersStoreRequest;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Users repository var
     * 
     * @var UsersRepository
     */
    private $_repo;

    public function __construct(UsersRepository $repo)
    {
        $this->_repo = $repo;
    }

    /**
     * Retrieve the authenticated user
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function user()
    {
        return $this->_repo->get(Auth::user()->id);
    }

    /**
     * Retrieve all users
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function users()
    {
        return $this->_repo->get();
    }

    /**
     * Save an user record
     *
     * @param UsersStoreRequest $request
     *
     * @return string
     */
    public function store(UsersStoreRequest $request)
    {
        $data = $request->validated();

        return (string)$this->_repo->store($data);
    }
}
