<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Privacy;
use App\Repositories\CommissionRepository;
use App\Repositories\DefaultRepository;

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
    public function index($display = 'historia') {
        $this->data['display'] = $display;
        $this->data['history'] = $this->repository->model(new History)->get();
        $this->data['commission'] = $this->commission->get();

        return view('about.index', $this->data);
    }

    public function privacy()
    {
        $this->data['sidebar'] = false;
        $this->data['privacy'] = $this->repository->model(new Privacy)->get();

        return view("privacy", $this->data);
    }
}
