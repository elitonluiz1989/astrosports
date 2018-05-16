<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersRepository
    {/**
     * @var array
     */
    public $fields = ['users.id', 'users.username', 'users.name', 'users.avatar', 'user_roles.name as role'];

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
        $grant = Auth::user()->grant;

        $users = User::join('user_roles', 'user_roles.id', '=', 'users.role')
                        ->select($this->fields);

        if ($grant == 1) {
            $users->where('grant', '<=', 1);
        } else {
            $users->where('grant', '<', $grant);
        }

        return $users->paginate($this->limit);
    }
}