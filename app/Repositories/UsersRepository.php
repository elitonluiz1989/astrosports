<?php

namespace App\Repositories;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersRepository
{
    use UserPermissionHandler;

    /**
     * @var int
     */
    public $limit = 0;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $path;

    /**
     * @var array
     */
    public $where = [];

    public function get($id = null)
    {
        $query = User::with('role')
                    ->with('role.grant');

        if (null != $id) {
            return $query->find($id);
        } else {
            if (!$this->isWebmaster()) {
                if (null == $this->getAuthUserGrant()) {
                    return $this->get(Auth::user()->id); // If the logged user does not have a grant, will only show himself
                } else {
                    $query->where('user_roles.grant', '>=', $this->getAuthUserGrant());
                }
            }

            return $query->paginate($this->limit);
        }
    }
}