<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchedulesCategory extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
    * SchedulesPole schedules
    * Retrive categories associeted with Schedule
    */
    public function schedules()
    {
        return $this->belongsTo('Schedule', 'name', 'category');
    }
}
