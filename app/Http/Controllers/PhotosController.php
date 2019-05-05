<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PhotosRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class PhotosController
 */
class PhotosController extends Controller
{
    /**
     * @var array
     */
    private $data;

    private $imageController;

    /**
     * @var PhotosRepositoryInterface
     */
    private $photos;


    /**
     * @var Request
     */
    private $request;

    /**
     * @var string
     */
    private $view;

    public function __construct(
        PhotosRepositoryInterface $photos,
        ImagesController $imageController,
        Request $request
    ) {
        $this->photos = $photos;
        $this->imageController = $imageController;
        $this->request = $request;

        $this->data = config('photos');
        $this->view = $this->data['views']['index'];
        $this->photos->limit = $this->data['limit'];
    }
    public function album(int $id)
    {
        $this->validatePage();

        if ($this->request->session()->has('albumId') && $this->request->session()->get('albumId') == $id)
        {
            $this->data['albumName'] = $this->request->session()->get('albumName');
        } else {
            $this->data['albumName'] = $this->photos->getAlbum($id)['name'];
            $this->request->session()->put('albumId', $id);
            $this->request->session()->put('albumName', $this->data['albumName']);
        }

        $this->photos->isOffsetPagination = true;
        $records = $this->photos->getPhotos($id);

        $this->recordsHandler($records);
        return view($this->view, $this->data);
    }

    public function albums()
    {
        $this->validatePage();

        $this->data['display'] = 'albums';
        $this->data['records']['isAlbum'] = true;
        $this->photos->isOffsetPagination = true;
        $this->photos->fields = ['id', 'name', 'cover_photo'];
        $records = $this->photos->getAlbums();

        $this->recordsHandler($records);

        return view($this->view, $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function photos()
    {
        $this->validatePage();

        $this->photos->isOffsetPagination = false;
        $records = $this->photos->getPhotos();

        $this->recordsHandler($records);

        return view($this->view, $this->data);
    }

    /**
     * @param Request $request
     * @param $filename
     * @return \Intervention\Image\Response
     */
    public function getPhoto(Request $request, $filename)
    {
        $this->imageController->setImagePath('photos');

        return $this->imageController->image($request, $filename);
    }

    /**
     * @param mixed $records
     */
    private function recordsHandler($records)
    {
        $this->data['records']['records'] = $records;

        if (method_exists($records, 'links')) {
            // This array hierarchy is necessary for that the blade @includes, in the template files, work correctly
            $this->data['records']['pagination']['links'] =  $records->links();
        } else {
            // Same of up
            $this->data['records']['pagination']['links'] = [];
        }
    }

    private function validatePage()
    {
        if ($this->request->has("page")) {
            $page = $this->request->get('page');

            if (null != $page) {
                $this->photos->page = (int)$page;
            }
        }

        if ($this->request->has("before") || $this->request->has("after")) {
            $page = $this->request->get('before');

            if (null != $page) {
                $this->photos->before = $page;
            }

            $page = $this->request->get('after');

            if (null != $page) {
                $this->photos->after = $page;
            }
        }
    }
}
