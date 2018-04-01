<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * Schedule poles
     * Get poles for schedules
     */
    public function poles()
    {
        return $this->hasOne('App\Models\SchedulesPole', 'id', 'pole');
    }

    /**
     * Schedule categories
     * Get poles for schedules
     */
    public function categories()
    {
        return $this->hasOne('App\Models\SchedulesCategory', 'id', 'category');
    }
}
