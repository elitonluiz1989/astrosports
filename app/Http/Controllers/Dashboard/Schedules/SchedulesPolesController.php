<?php

namespace App\Http\Controllers\Dashboard\Schedules;

use App\Http\Requests\SchedulesDefaultStoreRequest;
use App\Repositories\SchedulesPolesRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchedulesPolesController extends Controller
{
    private $poles;

    public function __construct(SchedulesPolesRepository $poles)
    {
        $this->poles = $poles;
    }

    public function poles($id = null)
    {
        try {
            $poles = $this->poles->get($id);

            return response()->json($poles);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(SchedulesDefaultStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $pole = $this->poles->store($data);

            return response()->json($pole);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->validate([
                'id' => 'integer|required'
            ])['id'];

            $schedule = $this->poles->delete($id);

            return response()->json($schedule);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
