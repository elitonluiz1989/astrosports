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

    public $width;

    public $height;

    /**
     * @var array
     */
    private $imgSize;

    /**
     * PhotosRepository constructor.
     */
    public function __construct()
    {
        $this->paginatePath = config('photos.url.photos');

        $this->imgSize = config('photos.cover');
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

    /**
     * @param int $width
     * @param int $height
     */
    public function resize(int $width, int $height)
    {
        if ($width != $this->imgSize['width']) {
            config()->set('photos.cover.width', $width);
        }

        if ($height != $this->imgSize['height']) {
            config()->set('photos.cover.height', $height);
        }
    }

    public function __destruct()
    {
        config()->set('photos.cover.width', $this->imgSize['width']);
        config()->set('photos.cover.height', $this->imgSize['height']);
    }
}
