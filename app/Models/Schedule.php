<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * Schedule pole
     * Get pole of schedule
     */
    public function pole()
    {
        return $this->hasOne('App\Models\SchedulesPole', 'id', 'pole');
    }

    /**
     * Schedule category
     * Get category of schedule
     */
    public function category()
    {
        return $this->hasOne('App\Models\SchedulesCategory', 'id', 'category');
    }
}
