<?php
namespace App\Repositories;

class DefaultRepository {
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param mixed $model
     * @return $this
     */
    public function model($model) {
        if (\is_object($model)) {
            $this->model = $model;
        } else {
            $className = '\\App\\Models\\' . \ucfirst($model);
            $this->model = new $className;
        }

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
}
