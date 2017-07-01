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
        $data = [
            'showSidebarVideos' => false,
            'videos' => Videos::get(39)
        ];

        return view('videos', $data);
    }
}
