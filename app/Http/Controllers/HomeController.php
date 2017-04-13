<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\HistoryRepository;
use App\Repositories\PhotosRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SchedulesRepository;
use App\Repositories\VideosRepository;

class HomeController extends Controller
{
    private $history;
    private $photos;
    private $news;
    private $schedules;
    private $videos;

    public function __construct(
        HistoryRepository $history,
        PhotosRepository $photos,
        NewsRepository $news,
        SchedulesRepository $schedules,
        VideosRepository $videos
    ) {
        $this->history = $history;
        $this->photos = $photos;
        $this->news = $news;
        $this->schedules = $schedules;
        $this->videos = $videos;
    }


    public function index() {
        $data = [
            'history' => $this->history->get("history"),
            'photos' => $this->photos->all(),
            'news' => $this->news->get()
        ];

        return view("home", $data);
    }
}
