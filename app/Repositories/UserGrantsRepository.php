<?php

namespace App\Repositories;

use App\Models\UserGrant as Grant;

class UserGrantsRepository
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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($id = null)
    {
        if (null !== $id) {
            return Grant::find($id);
        } else {
            return Grant::select($this->fields)
                            ->orderBy($this->order)
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
            $grant = $this->get($data['id']);
            $grant->name = $data['name'];
        } else {
            $grant = new Grant();
            $grant->name = $data['name'];
        }

        return $grant->save();
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return Grant::destroy($id);
    }
}