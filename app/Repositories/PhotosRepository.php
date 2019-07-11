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

    public function getAlbum($albumId)
    {
        return $this->albums->getAlbum($albumId);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function getAlbums()
    {
        $this->path = config('photos.url.albums');
        return $this->albums->get();
    }

    /**
     * @param null $albumId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPhotos($albumId = null) {
        $query = Photos::with('album');

        if (null != $albumId) {
            $query->where('album', '=', $albumId);
            $this->path = config('photos.url.album') . $albumId . '?legacy=true';
        }

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
}
