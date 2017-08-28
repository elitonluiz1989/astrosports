<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchedulesPoles extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
    * SchedulesPoles schedules
    * Retrive poles associeted with Schedules
    */
    public function schedules()
    {
        return $this->belongsTo('Schedules', 'name', 'pole');
    }
}
