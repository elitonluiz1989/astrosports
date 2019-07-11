<?php


namespace App\Handlers;

use App\Repositories\Contracts\PhotosRepositoryInterface;
use App\Repositories\PhotosRepository;
use Illuminate\Http\Request;

trait PhotosHandler
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var PhotosRepositoryInterface
     */
    private $photos;

    /**
     * @var PhotosRepository
     */
    private $legacyPhotos;


    /**
     * @var Request
     */
    private $request;

    /**
     * @var string
     */
    private $view;


    /**
     * @param mixed $records
     */
    private function recordsHandling($records)
    {
        $this->data['records']['records'] = $records;

        if (method_exists($records, 'links')) {
            // This array hierarchy is necessary for that the blade @includes, in the template files, work correctly
            $this->data['records']['pagination']['links'] =  $records->links();
        } else {
            // Same of up
            $this->data['records']['pagination']['links'] = [];
        }
    }

    private function pagingParametersHandling()
    {
        if ($this->request->has("page") && !empty($this->request->get('page'))) {
            $page = (int)$this->request->get('page');

            if ($this->request->has('legacy')) {
                $this->legacyPhotos->page = $page;
            } else {
                $this->photos->page = $page;
            }
        }

        if ($this->request->has("before") || $this->request->has("after")) {
            $page = $this->request->get('before');

            if (null != $page) {
                $this->photos->before = $page;
            }

            $page = $this->request->get('after');

            if (null != $page) {
                $this->photos->after = $page;
            }
        }
    }
}