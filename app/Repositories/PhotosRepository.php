<?php
namespace App\Repositories;

use App\Models\Photos;
use App\Repositories\Contracts\PhotosRepositoryInterface;

class PhotosRepository implements PhotosRepositoryInterface
{
    /**
     * @var array
     */
    public $fields = ['id', 'name', 'description'];

    /**
     * @var int
     */
    public $limit = 0;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $path;

    /**
     * @var array
     */
    public $where = [];

    /**
     * @var AlbumsRepository
     */
    private $albums;

    /**
     * @var array
     */
    private $imgSize;

    /**
     * PhotosRepository constructor.
     * @param AlbumsRepository $albums
     */
    public function __construct(AlbumsRepository $albums)
    {
        $this->albums = $albums;
        $this->path = config('photos.url.photos');
        $this->imgSize = config('photos.cover');
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAlbums()
    {
        $this->albums->limit = $this->limit;

        return $this->albums->get();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPhotos() {
        $query = Photos::with('album');

        if (count($this->where) > 0) {
            list($column, $signal, $value) = $this->where;
            $query->where($column, $signal, $value);
        }

        $photos = $query->select($this->fields)
                        ->paginate($this->limit);

        if ($this->path) {
            $photos->withPath($this->path);
        }


        return $photos;
    }

    /**
     * @param int $width
     * @param int $height
     */
    public function setSize(int $width, int $height)
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
