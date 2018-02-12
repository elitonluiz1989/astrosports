<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Repositories\Contracts\PhotosRepositoryInterface;
use App\Repositories\DefaultRepository;
use App\Repositories\NewsRepository;

class HomeController extends Controller
{
    /**
     * @var string
     */
    private $data;

    /**
     * @var NewsRepository $news
     */
    private $news;

    /**
     * @var PhotosRepositoryInterface $photos
     */
    private $photos;

    /**
     * @var DefaultRepository $repository
     */
    private $repository;

    /**
     * HomeController constructor.
     * @param DefaultRepository $repo
     * @param NewsRepository $news
     * @param PhotosRepositoryInterface $photos
     */
    public function __construct(
        DefaultRepository $repo,
        NewsRepository $news,
        PhotosRepositoryInterface $photos
    ) {
        $this->repository = $repo;
        $this->news = $news;
        $this->photos = $photos;

        $this->data = [];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $this->photos->limit = 5;
        /**
         * Facebook image sizes
         * 208x130
         * 360x225
         * 512x320
         * 767x480
         * 863x540
         * 960x600
         * 1151x720
         * 1534x960
         * 1650x1032
         */
        $size = config('facebook.image_sizes.767x480');
        $this->photos->setSize($size['width'], $size['height']);

        $this->data['history']  =  $this->repository->model(new History)->get('text');
        $this->data['photos']   =  $this->photos->getPhotos();
        $this->data['news']     =  $this->news->listNews();

        return view('home', $this->data);
    }
}
