<?php

namespace App\Repositories;

use App\Models\Commission;

class CommissionRepository
{
    /**
     * @var array
     */
    public $fields = ['commission.name', 'commission.avatar', 'commission_roles.name AS role'];

    /**
     * @param array $where
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($where = [])
    {
        $commission = Commission::join('commission_roles', 'commission_roles.id', '=', 'commission.role');

        if (count($where) > 0) {
            list($column, $signal, $value) = $where;
            $commission->where($column, $signal, $value);
        }

        $commission->select($this->fields);

        return $commission->get();
    }
}