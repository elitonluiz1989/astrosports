<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Repositories\UsersRolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersRolesController extends Controller
{
    private $roles;

    public function __construct(UsersRolesRepository $roles)
    {
        $this->roles = $roles;
    }

    public function roles($id = null)
    {
        return $roles = $this->roles->get($id);
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        return $this->roles->store($data);
    }

    public function delete(Request $request)
    {
        $id = $request->validate([
            'id' => 'integer|required'
        ])['id'];

        return $this->roles->delete($id);
    }
}
