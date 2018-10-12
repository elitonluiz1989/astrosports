<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Http\Requests\UserGrantsStoreRequest;
use App\Repositories\UserGrantsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserGrantsController extends Controller
{
    use UserPermissionHandler;

    private $grants;

    public function __construct(UserGrantsRepository $grants)
    {
        $this->grants = $grants;
    }

    public function grants($id = null)
    {
        if (null !== $id) {
            if ($this->isWebmaster() || $id >= $this->getAuthUserGrant()) {
                return $this->grants->get($id);
            } else {
                abort(403, config('dashboard.users.accessDeniedMessage'));
            }
        } else {
            return $this->grants->get();
        }
    }

    public function store(UserGrantsStoreRequest $request)
    {
        $data = $request->validated();
        return (string)$this->grants->store($data);
    }

    public function delete(Request $request)
    {
        $id = $request->validate([
            'id' => 'integer|required'
        ])['id'];

        return $this->grants->delete($id);
    }
}
