<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\SchedulesRepository;

/**
 * Class SchedulesController
 */
class SchedulesController extends Controller
{
    /**
     * @var string
     */
    private $view;

    /**
     * @var array
     */
    private $data;

    /**
     * @var SchedulesRepository
     */
    private $repo;

    public function __construct(
        SchedulesRepository $repo
    ) {
        $this->repo = $repo;

        $this->view = 'schedules';

        $this->data['sidebar'] = false;
        $this->data['display'] = 'schedules';
    }

    /**
     * SchedulesController schedules
     * @return View
     */
    public function schedules() {
        $this->data['content'] = $this->repo->get('categories');

        return view($this->view, $this->data);
    }


    /**
     * SchedulesController poles
     * @return View
     */
    public function poles() {
        $this->data['display'] = 'poles';
        $this->data['content'] = $this->repo->get('poles');

        return view($this->view, $this->data);
    }

    /**
     * SchedulesController categories
     * @return View
     */
    public function categories() {
        $this->data['display'] = 'categories';
        $this->data['content'] = $this->repo->get('categories');

        return view($this->view, $this->data);
    }
}
