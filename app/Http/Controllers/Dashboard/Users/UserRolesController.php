<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Http\Requests\UsersDefaultStoreRequest;
use App\Repositories\UserRolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRolesController extends Controller
{
    use UserPermissionHandler;

    /**
     * @var UserRolesRepository
     */
    private $roles;

    /**
     * UsersRolesController constructor.
     * @param UserRolesRepository $roles
     */
    public function __construct(UserRolesRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function roles($id = null)
    {
        if (null !== $id) {
            if ($this->isWebmaster() || $id >= $this->getAuthUserGrant()) {
                return $this->roles->get($id);
            } else {
                abort(403, config('dashboard.users.accessDeniedMessage'));
            }
        } else {
            return $this->roles->get();
        }
    }

    /**
     * @param UsersDefaultStoreRequest $request
     * @return string
     */
    public function store(UsersDefaultStoreRequest $request)
    {
        $data = $request->validated();
        return (string)$this->roles->store($data);
    }

    /**
     * @param Request $request
     * @return int
     */
    public function delete(Request $request)
    {
        $id = $request->validate([
            'id' => 'integer|required'
        ])['id'];

        return $this->roles->delete($id);
    }
}
