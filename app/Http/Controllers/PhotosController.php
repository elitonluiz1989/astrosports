<?php

namespace App\Http\Controllers;

use App\Handlers\PhotosHandler;
use App\Repositories\Contracts\PhotosRepositoryInterface;
use App\Repositories\PhotosRepository;
use Illuminate\Http\Request;

/**
 * Class PhotosController
 */
class PhotosController extends Controller
{
    use PhotosHandler;

    public function __construct(
        PhotosRepositoryInterface $photos,
        PhotosRepository $legacyPhotos,
        Request $request
    )
    {
        $this->photos = $photos;
        $this->photos->limit = 12;
        $this->legacyPhotos = $legacyPhotos;
        $this->legacyPhotos->limit = 12;
        $this->request = $request;

        $this->data = config('photos');
        $this->view = $this->data['views']['index'];
        $this->photos->limit = $this->data['limit'];
    }

    public function album(int $id)
    {
        $isLegacy = $this->request->has('legacy');

        $this->pagingParametersHandling();

        if ($this->request->session()->has('albumId') && $this->request->session()->get('albumId') == $id) {
            $this->data['albumName'] = $this->request->session()->get('albumName');
        } else {
            $currentAlbum =  $isLegacy ? $this->legacyPhotos->getAlbum($id) : $this->photos->getAlbum($id);
            $this->data['albumName'] = $currentAlbum['name'];
            $this->request->session()->put('albumId', $id);
            $this->request->session()->put('albumName', $this->data['albumName']);
        }

        if ($isLegacy) {
            $records = $this->legacyPhotos->getPhotos($id);
        } else {
            $this->photos->isOffsetPagination = false;
            $records = $this->photos->getPhotos($id);
        }

        $this->recordsHandling($records);
        return view($this->view, $this->data);
    }

    public function albums()
    {
        $this->pagingParametersHandling();

        $this->data['display'] = 'albums';
        $this->data['records']['isAlbum'] = true;
        $this->photos->isOffsetPagination = true;
        $this->photos->fields = ['id', 'name', 'cover_photo'];
        $records = $this->photos->getAlbums();

        $this->recordsHandling($records);

        return view($this->view, $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function photos()
    {
        $this->pagingParametersHandling();

        $this->photos->isOffsetPagination = false;
        $records = $this->photos->getPhotos();

        $this->recordsHandling($records);

        return view($this->view, $this->data);
    }

}
