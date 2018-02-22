<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use App\Repositories\AlbumsRepository;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

use App\Repositories\PhotosRepository;

/**
 * Class PhotosController
 */
class PhotosController extends Controller
{
    /**
     * @var string
     */
    private $view;

    /**
     * @var array
     */
    private $data;

    /**
     * @var AlbumsRepository
     */
    private $albums;

    /**
     * @var PhotosRepository
     */
    private $photos;

    /**
     * PhotosController constructor.
     * @param AlbumsRepository $albums
     * @param PhotosRepository $photos
     */
    public function __construct(
        AlbumsRepository $albums,
        PhotosRepository $photos
    ) {
        $this->view = 'photos.index';
        $this->albums = $albums;
        $this->photos = $photos;

        $this->data = config('photos');
        $this->albums->paginate = $this->data['limit'];
        $this->photos->paginate = $this->data['limit'];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPhotos() {
        $records = $this->photos->get();
        $this->definingContent($records);
        return view($this->view, $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAlbums() {
        $this->data['display'] = 'albums';
        $this->data['records']['isAlbum'] = true;
        $records = $this->albums->get();
        $this->definingContent($records);

        return view($this->view, $this->data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAlbum($id) {
        $id = (int)$id;
        $this->data['display'] = 'photos';
        $this->photos->paginatePath = config('photos.url.albums') . $id;
        $this->data['albumName'] = Albums::where('id', $id)
                                        ->first()['name'];
        $records = $this->photos->get(['album', '=', $id]);
        $this->definingContent($records);

        return view($this->view, $this->data);
    }

    /**
     * @param $records
     */
    private function definingContent($records)
    {
        $this->data['records']['records'] = $records;
        $this->data['records']['pagination']['links'] = $records->render();
    }

    /**
     * @param Request $request
     * @param $filename
     * @return mixed
     */
    public function getPhoto(Request $request, $filename) {
        $sizes = $request->all();
        $path = storage_path('app/photos/' . $filename);


        if (count($sizes) > 0) {
            $img = Image::make($path)
                ->resize($sizes['w'], $sizes['h']);
        } else {
            $img = Image::make($path);
        }

        $photoExt = explode('.', $filename);
        $photoExt = end($photoExt);

        return $img->response($photoExt);
    }
}
