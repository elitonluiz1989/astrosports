<?php

namespace App\Http\Controllers;

use App\Repositories\VideosRepository as Videos;

/**
 * Class VideosController
 */
class VideosController extends Controller
{
    /**
     * VidoesController index
     */
    public function index() {
        $videos = new Videos();
        $videos->videosAttrs = ['title', 'description', 'url', ['thumb', 'medium']];

        $data = [
            'sidebarVideos' => false,
            'channel'           => $videos->getChannel(),
            'videos'            => $videos->all()
        ];

        return view('videos', $data);
    }
}
