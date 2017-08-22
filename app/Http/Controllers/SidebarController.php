<?php

namespace App\Http\Controllers;

use App\Repositories\AdvertisingRepository as Advertising;
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

        return $schedules;
    }

    /**
     * SidebarController videos
     * Retrive two last videos of a channel
     */
    public function videos()
    {
        $videos = Videos::get(2);

        return array_map(function($video) {
            return [
                'url' => $video['url'],
                'img' => $video['img']['medium']
            ];
        }, $videos);
    }

    /**
     * Retrieve all advertings
     * @return array
     */
    public function advertising()
    {
        return (new Advertising)->get();
    }
}
