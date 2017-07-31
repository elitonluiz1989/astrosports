<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\News;
use App\Repositories\PhotosRepository as Photos;
use Illuminate\Database\Eloquent\Collection;

use App\Repositories\DefaultRepository;

class HomeController extends Controller
{
    /**
     * @var string
     */
    private $view;

    /**
     * @var string
     */
    private $data;

    /**
     * @var DefaultRepository $repository
     */
    private $repository;

    /**
     * HomeController constructor.
     * @param DefaultRepository $repo
     */
    public function __construct(DefaultRepository $repo) {
        $this->repository = $repo;

        $this->view = 'home';
        $this->data = [];
    }

    /**
     * @return View
     */
    public function index() {
        $photos = new Photos();
        $photos->paginate = 5;
        $photos->width = 600;
        $photos->height = 400;

        $this->data['history']  =  $this->repository->model(new History)->get('text');
        $this->data['photos']   =  $photos->get();
        $this->data['news']     =  $this->repository->model(new News)->get();

        return view($this->view, $this->data);
    }
}
