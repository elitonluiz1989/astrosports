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

        $this->data = config('schedules');
    }

    /**
     * SchedulesController index
     * @return View
     */
    public function index($display = 'schedules') {
        $this->data['display'] = $this->validateDisplayChoice($display);

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

    /**
     * SchedulesController validateDisplayChoice
     * @param string $display
     * @return string
     */
    private function validateDisplayChoice($display) {
        $validatedDisplay = str_replace(
            ['horarios', 'polos', 'categorias', 'horarios'],
            ['schedules', 'poles', 'categories', 'schedules'],
            $display
        );

        return $validatedDisplay;
    }
}
