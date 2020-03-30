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
        $commission = Commission::with('roles');

        if (count($where) > 0) {
            list($column, $signal, $value) = $where;
            $commission->where($column, $signal, $value);
        }

        return $commission->paginate($this->limit);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        if (isset($data['id'])) {
            $commission = Commission::find($data['id']);

            unset($data['1']);
        } else {
            $commission = new Commission();
        }

        foreach ($data as $column => $value) {
            $commission->$column = $value;
        }

        return $commission->save();
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return Commission::destroy($id);
    }
}