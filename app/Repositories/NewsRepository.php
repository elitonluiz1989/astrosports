<?php

namespace App\Repositories;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NewsRepository
{
    /**
     * @var array
     */
    private $originalFields = ['news.id', 'authors.name AS author', 'news.cover', 'news.title', 'news.text', 'news.created_at', 'news.updated_at'];


    /**
     * @var array
     */
    public $fields = [];

    /**
     * @var int
     */
    public $paginate = 10;

    public function __construct()
    {
        $this->fields = $this->originalFields;
    }

    /**
     * @param array $where
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($where = [], $limit = 0)
    {
        $news = News::join('authors', 'authors.id', '=', 'news.author');

        if (count($where) > 0) {
            list($column, $signal, $value) = $where;
            $news->where('news.' . $column, $signal, $value);
        }

        if ($limit > 0) {
            $news->limit($limit);
        }

        return $news->select($this->fields)
                    ->orderBy('updated_at', 'DESC')
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->paginate);
    }


    /**
     * @return mixed
     */
    public function listNews()
    {
        $this->fields = \array_diff($this->originalFields, ['news.text']);

         return $this->get();
    }
}
