<?php
namespace App\Repositories;

use App\Models\Albums;
use Illuminate\Support\Facades\DB;

class AlbumsRepository
{
    /**
     * @var int
     */
    public $limit = 0;

    /**
     * @var string
     */
    public $path;

    /**
     * AlbumsRepository constructor.
     */
    public function __construct()
    {
        $this->path = config('photos.url.albums');
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get() {
        $coverQuery = "(SELECT photos.name FROM photos WHERE photos.album = albums.id ORDER BY rand() LIMIT 1) AS cover";

        $albums = Albums::select()
                        ->addSelect(DB::raw($coverQuery))
                        ->paginate($this->limit);

        if ($this->path) {
            $albums->withPath($this->path);
        }

        return $albums;
    }

    /**
     * @param int $albumId
     * @return \Illuminate\Database\Eloquent\Collection;
     */
    public function getAlbum(int $albumId)
    {
        return Albums::find($albumId);
    }
}
