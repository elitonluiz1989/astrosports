<?php
namespace App\Repositories;

use Alaouy\Youtube\Facades\Youtube;

class VideosRepository {
    /**
     * Target youtube channel
     * @var string
     */
    private static $channel = 'UCupqHNRTEHjNtq9X8djWyaQ';

    /**
     * VideosRepository get
     * Retrive all videos
     * @param int $limit
     * @param string $order
     * @param bool $basicInfo
     * @return array
     */
    public static function get($limit = 40, $order = 'date', $basicInfo = true)
    {
        $videos = Youtube::listChannelVideos(self::$channel, $limit, $order);

        return ($basicInfo) ? self::basicVideosInfo($videos) : $videos;
    }

    /**
     * VideosRepository basicVideosInfo
     * Filter search result to return the essential video info
     * @param array $videos
     * @return array
     */
    private static function basicVideosInfo($videos)
    {
        return array_map(function($video) {
            return [
                'id'          => $video->id->videoId,
                'url'         => 'http://youtube.com/watch?v=' . $video->id->videoId,
                'title'       => $video->snippet->title,
                'description' => $video->snippet->description,
                'img'         => [
                    'default'   => $video->snippet->thumbnails->default->url,
                    'medium'    => $video->snippet->thumbnails->medium->url,
                    'high'      => $video->snippet->thumbnails->high->url
                ]
            ];
        }, $videos);
    }
}
