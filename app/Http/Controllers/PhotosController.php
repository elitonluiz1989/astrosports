<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PhotosRepositoryInterface;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class PhotosController
 */
class PhotosController extends Controller
{
    /**
     * @var array
     */
    private $data;

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

    /**
     * PhotosController constructor.
     * @param PhotosRepositoryInterface $photos
     */
    public function __construct(
        PhotosRepositoryInterface $photos,
        Request $resquest
    ) {
        $this->photos = $photos;
        $this->request = $resquest;

        $this->data = config('photos');
        $this->view = $this->data['views']['index'];
        $this->photos->limit = $this->data['limit'];
    }

    public function index()
    {
        $this->validatePage();

        $records = $this->photos->getPhotos();

        $this->recordsHandler($records);

        return view($this->view, $this->data);
    }

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

    private function validatePage()
    {
        $page = $this->request->get('page');

        if (null != $page) {
            $this->photos->page = (int)$page;
        }
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
}
