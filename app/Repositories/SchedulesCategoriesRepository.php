<?php

namespace App\Repositories;

use App\Models\SchedulesCategory as Category;

class SchedulesCategoriesRepository
{
    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($id = null)
    {
        if (null !== $id) {
            return Category::find($id);
        } else {
            return Category::all();
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
            $pole = new Category();
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
        return Category::destroy($id);
    }
}