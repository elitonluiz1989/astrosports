<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchedulesPole extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
    * SchedulesPole schedules
    * Retrive poles associeted with Schedule
    */
    public function schedules()
    {
        return $this->belongsTo('Schedule', 'name', 'pole');
    }
}
