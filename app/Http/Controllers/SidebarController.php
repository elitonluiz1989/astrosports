<?php

namespace App\Http\Controllers;

use App\Repositories\DefaultRepository as Repo;
use App\Repositories\SchedulesRepository as Schedules;
use App\Repositories\VideosRepository as Videos;

class SidebarController extends Controller
{
    /**
     * @var array
     */
    public $weekDays = [
        'sun' => 'DOM',
        'mon' => 'SEG',
        'tue' => 'TER',
        'wed' => 'QUA',
        'thu' => 'QUI',
        'fri' => 'SEX',
        'sat' => 'SÁB'
    ];

    /**
     * @var string
     */
    public $currentDay = strtolower(date('D'));

    /**
     * SidebarController schedules
     * Retrive all schedules ordered by day, hour, pole
     * @return array
     */
    public function schedules()
    {
        $schedules = (new Schedules)->getByDay();

        return $schedules;
    }

    /**
     * SidebarController videos
     * Retrive two last videos of a channel
     */
    public function videos()
    {
        return [];
        /*$videos = Videos::get(2);

        return array_map(function($video) {
            return [
                'url' => $video['url'],
                'img' => $video['img']['medium']
            ];
        }, $videos);*/
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
