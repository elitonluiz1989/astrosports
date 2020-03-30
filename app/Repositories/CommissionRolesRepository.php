<?php

namespace App\Repositories;

use App\Models\CommissionRoles;

class CommissionRolesRepository
{
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
     * @return mixed
     */
    public function get($id = null)
    {
        if (null !== $id) {
            return CommissionRoles::find($id);
        } else {
            return CommissionRoles::orderBy($this->order)
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
            $commissionRole = $this->get($data['id']);
        } else {
            $commissionRole = new CommissionRoles();
        }

        $commissionRole->name = $data['name'];

        return $commissionRole->save();
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return CommissionRoles::destroy($id);
    }
}