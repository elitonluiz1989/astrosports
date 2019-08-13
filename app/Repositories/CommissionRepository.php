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
     * @var int
     */
    public $limit = 12;

    /**
     * @param array $where
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($where = [])
    {
        $commission = Commission::with('role');

        if (count($where) > 0) {
            list($column, $signal, $value) = $where;
            $commission->where($column, $signal, $value);
        }

        return $commission->paginate($this->limit);
    }
}