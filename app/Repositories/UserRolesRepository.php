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
            return Role::with('grant')
                        ->find($id);
        } else {
            $query = Role::with('grant');

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
            $role = $this->get($data['id']);
        } else {
            $role = new Role();
        }

        $role->name = $data['name'];
        $role->grant_id = (int)$data['grant'];

        return $role->save();
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
