<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\News;
use App\Repositories\DefaultRepository;
use App\Repositories\NewsRepository;
use App\Repositories\PhotosRepository;

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
     * @var NewsRepository $news
     */
    private $news;


    /**
     * @var PhotosRepository $photos
     */
    private $photos;

    /**
     * HomeController constructor.
     * @param DefaultRepository $repo
     * @param NewsRepository $news
     * @param PhotosRepository $photos
     */
    public function __construct(
        DefaultRepository $repo,
        NewsRepository $news,
        PhotosRepository $photos
    ) {
        $this->repository = $repo;
        $this->news = $news;
        $this->photos = $photos;

        $this->data = [];
    }

    /**
     * @return View
     */
    public function index() {
        $this->photos->paginate = 5;
        $this->photos->resize(600,400);

        $this->data['history']  =  $this->repository->model(new History)->get('text');
        $this->data['photos']   =  $this->photos->get();
        $this->data['news']     =  $this->news->listNews();

        return view('home', $this->data);
    }
}
