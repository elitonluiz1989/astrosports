<?php

namespace App\Handlers\Facebook;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use IteratorAggregate;

class FacebookResponsePagingHandler
{
    /**
     * @var string
     */
    public $baseUrl;

    /**
     * @var array
     */
    public $data;

    /**
     * @return string
     */
    public function GetPrevUrl()
    {
        return $this->baseUrl . "?before=" . $this->GetCursor('before');
    }

    /**
     * @return string
     */
    public function GetNextUrl()
    {
        return $this->baseUrl . "?after=" . $this->GetCursor('after');
    }

    /**
     * @return bool
     */
    public function IsFirstPage()
    {
        return !isset($this->data['previous']);
    }

    /**
     * @return bool
     */
    public function IsLastPage()
    {
        return !isset($this->data['next']);
    }

    /**
     * @param string $cursor
     * @return string
     */
    public function GetCursor(string $cursor)
    {
        return $this->data['cursors'][$cursor] ?? "";
    }
}

class FacebookResponseHandler  implements Arrayable, IteratorAggregate
{
    /**
     * @var FacebookResponsePagingHandler
     */
    public $paging;

    /**
     * @var Collection
     */
    public $items;

    public function __construct()
    {
        $this->paging = new FacebookResponsePagingHandler();
        $this->items = new Collection();
    }

    /**
     * @return array
     */
    public function toArray() {
        return $this->items->toArray();
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return $this->items->getIterator();
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->items->count();
    }
}