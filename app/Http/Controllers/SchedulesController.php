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
    }

    /**
     * SchedulesController index
     * @return View
     */
    public function index($display = 'schedules') {
        $this->data['display'] = ($display == 'schedules') ? $display : $this->validateDisplayChoice($display);
        
        $this->data['poles'] = $this->repo->getBy('pole');
        $this->data['categories'] = $this->repo->getBy('category');
        $this->data['schedules'] = $this->repo->getBy('hour');

        return view($this->view, $this->data);
    }

    /**
     * SchedulesController validateDisplayChoice
     * @param string $display
     * @return string
     */
    private function validateDisplayChoice($display) {
        $validatedDisplay = str_replace(
            ['polos', 'categorias'],
            ['poles', 'categories'],
            $display
        );

        return $validatedDisplay;
    }
}
