<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

use App\Repositories\PhotosRepository;

class PhotosController extends Controller
{
    private $view;
    private $repo;

    public function __construct(
        ViewHelper $view,
        PhotosRepository $repo
    ) {
        $this->view = $view;
        $this->repo = $repo;

        $this->view->setVar('view', 'photos');
        $this->view->setVar('showSidebar', false);
        $this->view->setVar('albums', true);
        $this->view->setVar('display', 'fotos');
        $this->view->setVar('qty', 7);
    }

    public function displayPhotos($page = 1) {
        $this->view->setVar('page', (int)$page);
        $this->view->setVar('photos', $this->repo->get('photos'));
        return $this->view->render();
    }

    public function displayAlbums($page = 1) {
        $this->view->setVar('display', 'albums');
        $this->view->setVar('page', (int)$page);
        $this->view->setVar('photos', $this->repo->get('albums'));

        return $this->view->render();
    }

    public function displayAlbum($id, $page = 1) {
        $this->view->setVar('display', 'album');
        $this->view->setVar('albumId', $id);
        $this->view->setVar('page', (int)$page);
        $this->view->setVar('photos', $this->repo->get('photos'));

        return $this->view->render();
    }

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
}
