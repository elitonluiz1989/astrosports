<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Http\Requests\UserRolesStoreRequest;
use App\Repositories\UserRolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRolesController extends Controller
{
    use UserPermissionHandler;

    /**
     * @var UserRolesRepository
     */
    private $_roles;

    /**
     * UsersRolesController constructor.
     * @param UserRolesRepository $roles
     */
    public function __construct(UserRolesRepository $roles)
    {
        $this->_roles = $roles;
    }

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function roles($id = null)
    {
        if (null !== $id) {
            if ($this->isWebmaster() || $id >= $this->getAuthUserGrant()) {
                return $this->_roles->get($id);
            } else {
                abort(403, config('dashboard.users.accessDeniedMessage'));
            }
        } else {
            return $this->_roles->get();
        }
    }

    /**
     * @param UserRolesStoreRequest $request
     * @return string
     */
    public function store(UserRolesStoreRequest $request)
    {
        $data = $request->validated();

        return (string)$this->_roles->store($data);
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

        return $this->_roles->delete($id);
    }
}
