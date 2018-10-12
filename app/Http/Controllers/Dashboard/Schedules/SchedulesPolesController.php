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
        return $this->poles->get($id);
    }

    public function store(SchedulesDefaultStoreRequest $request)
    {
        $data = $request->validated();
        // This string cast is necessary because RESPONSE doesn't allow BOOLEAN values with return
        return (string)$this->poles->store($data);
    }

    public function delete(Request $request)
    {
        $id = $request->validate([
            'id' => 'integer|required'
        ])['id'];

        return $this->poles->delete($id);
    }
}
