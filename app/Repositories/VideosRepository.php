<?php
namespace App\Repositories;

use Alaouy\Youtube\Facades\Youtube;

class VideosRepository
{
    /**
     * @var int
     */
    public $limit = 9;

    /**
     * @var string
     */
    public $order = 'date';

    /**
     * Target youtube channel
     * @var string
     */
    private $channel;

    /**
     * VideosRepository constructor.
     */
    public function __construct()
    {
        $this->channel = 'UCupqHNRTEHjNtq9X8djWyaQ';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function get()
    {
        $videos = Youtube::listChannelVideos($this->channel, $this->limit, $this->order);

        return collect($videos);
    }

    /**
     * @param array ...$fields
     * @return \Illuminate\Support\Collection
     */
    public function basicGet(...$fields)
    {
        $videos = $this->get();

        return $videos->map(function($video) use ($fields) {
            $record = collect();

            foreach ($fields as $field) {
                if ($field == 'id') {
                    $record->put('id', $video->id->videoId);
                } else if ($field == 'url') {
                    $record->put('url', 'http://youtube.com/watch?v=' . $video->id->videoId);
                } else if ($field == 'thumb') {
                    $record->put('thumb', $video->snippet->thumbnails);
                } else if (\is_array($field)) {
                    $size = $field[1];
                    $record->put('thumb', $video->snippet->thumbnails->$size->url);
                } else {
                    $record->put($field, $video->snippet->$field);
                }
            }

            return $record;
        });
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return 'https://www.youtube.com/channel/' . $this->channel;
    }
}
