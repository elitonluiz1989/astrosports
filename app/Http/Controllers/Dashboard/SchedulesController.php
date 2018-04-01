<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\SchedulesStoreRequest;
use App\Repositories\SchedulesRepository;
use App\Http\Controllers\Controller;

class SchedulesController extends Controller
{
    /**
     * @var SchedulesRepository
     */
    private $schedules;

    public function __construct(SchedulesRepository $schedules)
    {
        $this->schedules = $schedules;
    }

    public function schedules($id = null)
    {
        try {
            $this->schedules->fields = ['id', 'hour', 'day', 'pole', 'category'];
            $schedules = $this->schedules->listSchedules();

            return response()->json($schedules);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(SchedulesStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $schedule = $this->schedules->storeSchedule($data);

            return response()->json($schedule);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
