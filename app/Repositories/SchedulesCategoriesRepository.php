<?php

namespace App\Repositories;

use App\Models\SchedulesCategory as Category;

class SchedulesCategoriesRepository
{
    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategories($id = null)
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
    public function storeCategory(array $data)
    {
        if (isset($data['id'])) {
            $pole = $this->getCategories($data['id']);
            $pole->name = $data['name'];
        } else {
            $pole = new Category();
            $pole->name = $data['name'];
        }

        return $pole->save();
    }
}