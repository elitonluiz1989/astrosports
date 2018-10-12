<?php

namespace App\Repositories;

use App\Models\SchedulesPole as Pole;

class SchedulesPolesRepository
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
            return Pole::find($id);
        } else {
            return Pole::select($this->fields)
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
            $pole = $this->get($data['id']);
            $pole->name = $data['name'];
        } else {
            $pole = new Pole();
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
        return Pole::destroy($id);
    }
}