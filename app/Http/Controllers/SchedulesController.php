<?php

namespace App\Http\Controllers;

use App\Repositories\SchedulesRepository;

/**
 * Class SchedulesController
 */
class SchedulesController extends Controller
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var SchedulesRepository
     */
    private $repo;

    /**
     * @var string
     */
    private $view;

    /**
     * SchedulesController constructor.
     * @param SchedulesRepository $repo
     */
    public function __construct(
        SchedulesRepository $repo
    ) {
        $this->repo = $repo;

        $this->view = 'schedules.index';

        $this->data = config('schedules');
    }

    /**
     * @param string $display
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($display = 'horarios') {
        $this->data['display'] = $display;

        if ($this->data['vacation']) {
            $this->data['noResultsMessage']['message'] = $this->data['vacationMessage'];

            $this->data['poles'] = [];
            $this->data['categories'] = [];
            $this->data['schedules'] = [];
        } else {
            $this->data['poles'] = $this->repo->getPoles();
            $this->data['categories'] = $this->repo->getCategories();
            $this->data['schedules'] = $this->repo->getSchedules();
        }

        return view($this->view, $this->data);
    }
}
