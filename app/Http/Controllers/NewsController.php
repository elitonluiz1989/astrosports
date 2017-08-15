<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepository;

class NewsController extends Controller
{
    /**
     * @var NewsRepository
     */
    private $news;

    /**
     * @var array
     */
    private $data;

    /**
     * NewsController constructor.
     * @param NewsRepository $news
     */
    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
        $this->data = config('news');
    }

    public function index() {
        $this->news->paginate = $this->data['limit'];
        $this->data['news'] = $this->news->listNews();

        //if ($this->data['news']->total() > $this->data['limit']) {
            $this->data['pagination']['links'] = $this->data['news']->links();
        //}

        return view('news', $this->data);
    }
}
