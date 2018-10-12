<?php

namespace App\Http\Controllers\Dashboard\Schedules;

use App\Http\Requests\SchedulesStoreRequest;
use App\Repositories\SchedulesRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $this->schedules->fields = ['id', 'hour', 'day', 'pole', 'category'];
        return $this->schedules->listSchedules();
    }

    public function store(SchedulesStoreRequest $request)
    {
        $data = $request->validated();
        // This string cast is necessary because RESPONSE doesn't allow BOOLEAN values with return
        return (string) $this->schedules->storeSchedule($data);
    }

    public function delete(Request $request)
    {
        $id = $request->validate([
            'id' => 'integer|required'
        ])['id'];

        return $this->schedules->deleteSchedule($id);
    }
}
