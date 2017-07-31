<?php
namespace App\Repositories;

class DefaultRepository {
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param $model
     * @return $this
     */
    public function model($model) {
        $this->model = $model;

        return $this;
    }

    /**
     * DefaultAbstractRepository get
     * Retrieves all results or a specific result by id
     * @param int|null $id
     * @return Collection
     */
    public function get($id = null) {
        if (null == $id) {
            return $this->model::all();
        } else {
            return $this->model::find($id);
        }
    }

    /**
     * @param array $fields
     * @return Collection
     */
    public function select(Array $fields)
    {
        return $this->model::select($fields)
                            ->get();
    }
}
