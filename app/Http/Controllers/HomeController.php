<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\HistoryRepository;
use App\Repositories\PhotosRepository;
use App\Repositories\NewsRepository;

class HomeController extends Controller
{
    private $view;
    private $history;
    private $photos;
    private $news;

    public function __construct(
        ViewHelper $view,
        HistoryRepository $history,
        PhotosRepository $photos,
        NewsRepository $news
    ) {
        $this->view = $view;
        $this->history = $history;
        $this->photos = $photos;
        $this->news = $news;

        $this->view->setVar('view', 'home');
    }


    public function index() {
        $this->view->setVar('history', $this->history->get('history'));
        $this->view->setVar('photos', $this->photos->get('photos'));
        $this->view->setVar('news', $this->news->get());

        return $this->view->render();
    }
}
