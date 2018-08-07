<?php

namespace App\Repositories;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Models\UserRole as Role;

class UserRolesRepository
{
    use UserPermissionHandler;

    /**
     * @var array
     */
    public $fields = ['id', 'name'];

    /**
     * @var string
     */
    public $order = 'id';

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($id = null)
    {
        if (null !== $id) {
            return Role::find($id);
        } else {
            $query = Role::select($this->fields);

            if (!$this->isWebmaster()) {
                $query->where('id', '>=', $this->getAuthUserGrant());
            }

            return $query->orderBy($this->order)
                         ->get();
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        if (isset($data['id'])) {
            $pole = $this->get($data['id']);
            $pole->name = $data['name'];
        } else {
            $pole = new Role();
            $pole->name = $data['name'];
        }

        return $pole->save();
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return Role::destroy($id);
    }
}