<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SchedulesRepository as Schedules;
use App\Repositories\VideosRepository as Videos;

class SidebarController extends Controller
{
    /**
     * SidebarController schedules
     * Retrive all schedules ordered by day, hour, pole
     * @return array
     */
    public function schedules()
    {
        $fields = ['hour', 'day', 'pole', 'category'];
        $order =  ['hour', 'pole', 'category'];
        $schedules = (new Schedules)->getByDay($fields, $order);

        $schedulesArr = $schedules->groupBy('day')
                    ->transform(function($item, $i) {
                        return $item->groupBy('hour')
                                ->transform(function ($item, $i) {
                                    return $item->groupBy('pole');
                                });
                    });

        $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
        foreach($days as $day) {
            if (!isset($schedulesArr[$day])) {
                $schedulesArr[$day] = null;
            }
        }

        return $schedulesArr->toArray();
    }
}
