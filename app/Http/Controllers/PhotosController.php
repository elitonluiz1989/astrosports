<?php

namespace App\Http\Controllers;

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
     * @var PhotosRepository
     */
    private $repo;

    public function __construct(PhotosRepository $repo) {
        $this->view = 'photos';
        $this->repo = $repo;

        $this->data = [
            'display' => 'photos',
            'sidebar' => false,
            'limit'   => 7
        ];
    }

    /**
     * PhotosController displayPhotos
     * @param int $page
     * @return View
     */
    public function displayPhotos($page = 1) {
        $this->data['page'] = (int)$page;

        $this->getContent();

        return view($this->view, $this->data);
    }

    /**
     * PhotosController displayAlbuns
     * @param int $page
     * @return View
     */
    public function displayAlbums($page = 1) {
        $this->data['display'] = 'albums';
        $this->data['page'] = (int)$page;

        $this->getContent();

        return view($this->view, $this->data);
    }

    /**
     * PhotosController displayAlbum
     * @param int $id
     * @param int $page
     * @return View
     */
    public function displayAlbum($id, $page = 1) {
        $this->data['albumId'] = $id;
        $this->data['page'] = (int)$page;
        $this->data['photos'] = $this->repo->get('photos');

        return view($this->view, $this->data);
    }

    /**
     * PhotosController getPhoto
     * @param  Request $request
     * @param string $filename
     * @return ImageManagerStatic
     */
    public function getPhoto(Request $request, $filename) {
        $sizes = $request->all();
        $path = storage_path('app/photos/' . $filename);

        if (count($sizes) > 0) {
            $img = Image::make($path)->resize($sizes['w'], $sizes['h']);
        } else {
            $img = Image::make($path);
        }

        $photoExt = explode('.', $filename);
        $photoExt = end($photoExt);

        return $img->response($photoExt);
    }

    /**
     * VideosController getContent
     * Retrive all photos and albums on database
     * @return array
     */
    private function getContent()
    {
        $this->data['photos'] = $this->repo->get('photos');
        $this->data['albums'] = $this->repo->get('albums');
    }
}
