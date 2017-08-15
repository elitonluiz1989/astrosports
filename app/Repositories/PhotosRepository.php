<?php
namespace App\Repositories;

use App\Models\Photos;

class PhotosRepository
{
    /**
     * @var int
     */
    public $paginate = 0;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $paginatePath;

    /**
     * @var array
     */
    public $fields = ['id', 'name', 'description'];

    /**
     * PhotosRepository constructor.
     */
    public function __construct()
    {
        $this->paginatePath = config('photos.url.photos');
    }

    /**
     * @param array $where
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($where = []) {
        $query = Photos::with('album');

        if (count($where)) {
            list($column, $signal, $value) = $where;
            $query->where($column, $signal, $value);
        }

        $photos = $query->select($this->fields)
                        ->paginate($this->paginate);

        if ($this->paginatePath) {
            $photos->withPath($this->paginatePath);
        }


        return $photos;
    }
}
