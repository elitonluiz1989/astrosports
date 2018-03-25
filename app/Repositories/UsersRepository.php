<?php

namespace App\Repositories;


use App\Models\User;

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
        $users = User::join('user_roles', 'user_roles.id', '=', 'users.role')
                        ->select($this->fields)
                        ->paginate($this->limit);

        return $users;
    }
}