<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\SchedulesDefaultStoreRequest;
use App\Repositories\SchedulesCategoriesRepository;
use App\Http\Controllers\Controller;

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
            $categories = $this->categories->getCategories($id);

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(SchedulesDefaultStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $category = $this->categories->storeCategory($data);

            return response()->json($category);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
