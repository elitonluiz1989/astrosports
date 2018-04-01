<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\SchedulesDefaultStoreRequest;
use App\Repositories\SchedulesPolesRepository;
use App\Http\Controllers\Controller;

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
            $poles = $this->poles->getPoles($id);

            return response()->json($poles);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(SchedulesDefaultStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $pole = $this->poles->storePole($data);

            return response()->json($pole);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
