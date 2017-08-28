<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchedulesCategories extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
    * SchedulesPoles schedules
    * Retrive categories associeted with Schedules
    */
    public function schedules()
    {
        return $this->belongsTo('Schedules', 'name', 'category');
    }
}
