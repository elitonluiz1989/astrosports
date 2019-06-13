<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Http\Requests\Dashboard\Users\UserGrantsStoreRequest;
use App\Repositories\UserGrantsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserGrantsController extends Controller
{
    use UserPermissionHandler;

    private $_grants;

    public function __construct(UserGrantsRepository $grants)
    {
        $this->_grants = $grants;
    }

    public function grants($id = null)
    {
        if (null !== $id) {
            if ($this->isWebmaster() || $id >= $this->getAuthUserGrant()) {
                return $this->_grants->get($id);
            } else {
                abort(403, config('dashboard.users.accessDeniedMessage'));
            }
        } else {
            return $this->_grants->get();
        }
    }

    public function store(UserGrantsStoreRequest $request)
    {
        $data = $request->validated();
        return (string)$this->_grants->store($data);
    }

    public function delete(Request $request)
    {
        $id = $request->validate([
            'id' => 'integer|required'
        ])['id'];

        return $this->_grants->delete($id);
    }
}
