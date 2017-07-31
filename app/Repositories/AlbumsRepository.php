<?php
namespace App\Repositories;

use App\Models\Albums;
use Illuminate\Support\Facades\DB;

class AlbumsRepository
{
    /**
     * @var int
     */
    public $paginate = 0;

    /**
     * @var string
     */
    public $paginatePath;

    /**
     * AlbumsRepository constructor.
     */
    public function __construct()
    {
        $this->paginatePath = config('photos.url.albums');
    }

    /**
     * @return mixed
     */
    public function get() {
        $coverQuery = "(SELECT photos.name FROM photos WHERE photos.album = albums.id ORDER BY rand() LIMIT 1) AS cover";

        $albums = Albums::select()
                        ->addSelect(DB::raw($coverQuery))
                        ->paginate($this->paginate);

        if ($this->paginatePath) {
            $albums->withPath($this->paginatePath);
        }

        return $albums;
    }
}
