<?php
namespace App\Repositories;

use App\Models\Schedules;

class SchedulesRepository {
    public function get($id = null) {
        if (null != $id) {
            return Schedules::find($id);
        } else {
            return Schedules::all();
        }
    }
}
