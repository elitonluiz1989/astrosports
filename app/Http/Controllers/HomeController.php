<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\HistoryRepository;
use App\Repositories\PhotosRepository;
use App\Repositories\NewsRepository;

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
     * @var HistoryRepository
     */
    private $history;

    /**
     * @var PhotosRepository
     */
    private $photos;

    /**
     * @var NewsRepository
     */
    private $news;

    public function __construct(
        HistoryRepository $history,
        PhotosRepository $photos,
        NewsRepository $news
    ) {
        $this->history = $history;
        $this->photos = $photos;
        $this->news = $news;

        $this->view = 'home';
        $this->data = [];
    }

    /**
     * HomeController index
     * @return view
     */
    public function index() {
        $this->data['history']  =  $this->history->get('history');
        $this->data['photos']   =  $this->photos->get('photos');
        $this->data['news']     =  $this->news->get();

        return view($this->view, $this->data);
    }
}
