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
        return $this->categories->get($id);
    }

    public function store(SchedulesDefaultStoreRequest $request)
    {
        $data = $request->validated();
        return $this->categories->store($data);
    }

    public function delete(Request $request)
    {
        $id = $request->validate([
            'id' => 'integer|required'
        ])['id'];

        return $this->categories->delete($id);
    }
}
