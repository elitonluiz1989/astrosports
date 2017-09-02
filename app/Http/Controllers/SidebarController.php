<?php

namespace App\Http\Controllers;

use App\Repositories\DefaultRepository as Repo;
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
        $schedules = (new Schedules)->getByDay();

        return [
            'weekDays'   => [
                'sun' => 'DOM',
                'mon' => 'SEG',
                'tue' => 'TER',
                'wed' => 'QUA',
                'thu' => 'QUI',
                'fri' => 'SEX',
                'sat' => 'SÁB'
            ],
            'currentDay' => \strtolower(\date('D')),
            'schedules'  => $schedules
        ];
    }

    /**
     * SidebarController videos
     * Retrieve two last videos of a channel
     */
    public function videos()
    {
        $videos = new Videos();
        $videos->videosAttrs = ['title', 'url', ['thumb', 'medium']];
        $videos->limit = 2;
        $records = $videos->all();

        return ['videos' => $records];
    }

    /**
     * Retrieve all advertings
     * @return Collection
     */
    public function advertising()
    {
        return (new Repo)->model('advertising')->get();
    }
}
