<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\SchedulesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchedulesController extends Controller
{
    private $repo;

    public function __construct(SchedulesRepository $repo)
    {
        $this->repo = $repo;
    }

    public function schedules($id = null)
    {
        try {
            $schedules = $this->repo->getSchedules();

            return response()->json($schedules);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
