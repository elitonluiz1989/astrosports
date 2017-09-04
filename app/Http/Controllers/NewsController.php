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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $this->news->paginate = $this->data['limit'];
        $this->data['news'] = $this->news->listNews();

        if ($this->data['news']->total() > $this->data['limit']) {
            $this->data['pagination']['links'] = $this->data['news']->links();
        }

        return view('news', $this->data);
    }

    /**
     * @param string $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNews(string $news)
    {
        $id = (int)explode('_', $news)[0];

        $this->data['showChosenNews'] = true;
        $this->data['news'] = $this->news->get(['id', '=', $id])[0];
        return view('news', $this->data);
    }
}
