<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $data = [
            'sidebarVideos' => false,
            'channel'           => $videos->getChannel(),
            'videos'            => $videos->basicGet('title', 'description', 'url', 'thumb')
        ];

        return view('videos', $data);
    }
}
