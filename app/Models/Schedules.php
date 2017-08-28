<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    /**
     * Schedules poles
     * Get poles for schedules
     */
    public function poles()
    {
        return $this->hasOne('App\Models\SchedulesPoles', 'id', 'pole');
    }

    /**
     * Schedules categories
     * Get poles for schedules
     */
    public function categories()
    {
        return $this->hasOne('App\Models\SchedulesCategories', 'id', 'category');
    }
}
