<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Repositories\CommissionRepository;
use App\Repositories\DefaultRepository;
use Illuminate\Http\Request;

/**
 * Class AboutController
 */
class AboutController extends Controller
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var DefaultRepository
     */
    private $repository;

    /**
     * @var CommissionRepository
     */
    private $commission;

    public function __construct(
        DefaultRepository $repo,
        CommissionRepository $commission
    )
    {
        $this->repository = $repo;
        $this->commission = $commission;
        $this->data = config('about');
    }

    /**
     * @param string $display
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($display = 'history') {
        $this->data['display'] = $this->validateDisplayChoice($display);
        $this->data['history'] = $this->repository->model(new History)->get();
        $this->data['commission'] = $this->commission->get();

        //dd($this->data);

        return view('about', $this->data);
    }

    /**
     * @param string $display
     * @return string
     */
    private function validateDisplayChoice(string $display) {
        $validatedDisplay = str_replace(
            ['historia', 'cartilha', 'jogadores', 'comissao'],
            ['history', 'primer', 'players', 'commission'],
            $display
        );

        return $validatedDisplay;
    }
}
