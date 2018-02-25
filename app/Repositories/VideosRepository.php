<?php
namespace App\Repositories;

use Alaouy\Youtube\Facades\Youtube;
use Illuminate\Support\Collection;

class VideosRepository
{
    /**
     * @var array
     */
    public $videosAttrs = [];

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
        $this->channel = config('youtube.channel');
    }

    /**
     * @return Collection
     */
    public function all()
    {
        $videos = collect();

        $uploadsVideos = $this->getUplaodsVideos();
        $videos = $videos->merge($uploadsVideos);

        $playlistsVideos = $this->getPlaylistsVideos();
        $videos = $videos->merge($playlistsVideos);


        $videos = $videos->sortByDesc('publishedAt');
        $videos->splice($this->limit);

        return $videos;
    }

    /**
     * @return Collection
     */
    public function getUplaodsVideos()
    {
        $uploadsVideos = Youtube::listChannelVideos($this->channel, $this->limit, $this->order);

        if ($uploadsVideos) {
            return $this->videosDataTreatment($uploadsVideos);
        } else {
            return collect([]);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getPlaylistsVideos()
    {
        $playlistsVideos = collect();
        $playlists = $this->getPlaylists();

        if ($playlists) {
            foreach ($playlists as $playlist) {
                $videos = Youtube::getPlaylistItemsByPlaylistId($playlist['id'], '', $this->limit)['results'];
                $videos = $this->videosDataTreatment($videos);

                $playlistsVideos = $playlistsVideos->merge($videos);
            }

            return collect($playlistsVideos);
        } else {
            return collect([]);
        }
    }

    /**
     * @param array $videosData
     * @return \Illuminate\Support\Collection
     */
    public function videosDataTreatment(array $videosData)
    {
        if (count($this->videosAttrs) > 0) {
            return collect($videosData)->map(function ($video) {
                $record = collect();

                foreach ($this->videosAttrs as $attr) {
                    if ($attr == 'id') {
                        $videoId = $video->id->videoId ?? $video->contentDetails->videoId;
                        $record->put('id', $videoId);
                    } else if ($attr == 'url') {
                        $videoUrl = ($video->kind == 'youtube#playlistItem') ?
                        $video->snippet->resourceId->videoId . '&list=' . $video->snippet->playlistId : $video->id->videoId;

                        $record->put('url', 'http://youtube.com/watch?v=' . $videoUrl);
                    } else if ($attr == 'thumb') {
                        $record->put('thumb', $video->snippet->thumbnails);
                    } else if (\is_array($attr)) {
                        $size = $attr[1];
                        $record->put('thumb', $video->snippet->thumbnails->$size->url);
                    } else {
                        $record->put($attr, $video->snippet->$attr);
                    }

                    $record->put('publishedAt', $video->snippet->publishedAt);
                }

                return $record;
            });
        }
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return 'https://www.youtube.com/channel/' . $this->channel;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getPlaylists()
    {
        $playlists =  Youtube::getPlaylistsByChannelId($this->channel)['results'];

        return collect($playlists)->map(function($playlist) {
            return ['id' => $playlist->id, 'title' => $playlist->snippet->title];
        });
    }
}
