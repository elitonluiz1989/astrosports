<?php

namespace App\Repositories;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Models\User;

class UsersRepository
{
    use UserPermissionHandler;

    /**
     * @var array
     */
    public $fields = ['users.id', 'users.username', 'users.name', 'users.avatar', 'users.role as grant', 'user_roles.name as role'];

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

    public function get()
    {
        $users = User::join('user_roles', 'user_roles.id', '=', 'users.role')
                    ->select($this->fields);

        if (!$this->isWebmaster()) {
            $users->where('users.role', '>=', $this->getAuthUserGrant());
        }

        return $users->paginate($this->limit);
    }
}