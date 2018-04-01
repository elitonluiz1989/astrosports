<?php

namespace App\Repositories;

use App\Models\SchedulesPole as Pole;

class SchedulesPolesRepository
{
    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPoles($id = null)
    {
        if (null !== $id) {
            return Pole::find($id);
        } else {
            return Pole::all();
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function storePole(array $data)
    {
        if (isset($data['id'])) {
            $pole = $this->getPoles($data['id']);
            $pole->name = $data['name'];
        } else {
            $pole = new Pole();
            $pole->name = $data['name'];
        }

        return $pole->save();
    }
}