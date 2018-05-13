<?php

namespace App\Http\Controllers\Dashboard\Schedules;

use App\Http\Requests\SchedulesDefaultStoreRequest;
use App\Repositories\SchedulesCategoriesRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchedulesCategoriesController extends Controller
{
    private $categories;

    public function __construct(SchedulesCategoriesRepository $category)
    {
        $this->categories = $category;
    }

    public function categories($id = null)
    {
        try {
            $categories = $this->categories->get($id);

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(SchedulesDefaultStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $category = $this->categories->store($data);

            return response()->json($category);
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

            $schedule = $this->categories->delete($id);

            return response()->json($schedule);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
