<?php
namespace App\Repositories;

use App\Repositories\Abstracts\FacebookBase;
use App\Repositories\Contracts\PhotosRepositoryInterface;
use Facebook\GraphNodes\GraphEdge;
use Illuminate\Support\Collection;

class FacebookPhotosRepository extends FacebookBase implements PhotosRepositoryInterface
{
    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator|Collection
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getAlbums()
    {
        $this->setFields('name');

        $uri = $this->pageId . '/albums';

        $returnedValues = $this->getResponseValues($uri);

        $this->totalItems = $returnedValues->count();
        $this->path = config('photos.url.albums');

        $albums = $this->iterateAlbums($returnedValues);

        return $this->paginateResult($albums);
    }

    /**
     * @param null $albumId
     * @return \Illuminate\Pagination\LengthAwarePaginator|Collection
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getPhotos($albumId = null)
    {
        $photos = collect([]);

        // Set fields to photos search
        $this->setFields(['id', 'name', 'source', 'album{id,name}']);
        $this->path = config('photos.url.photos');

        if (null == $albumId) {
            $this->setTotalItems();

            $uri = $this->pageId . '/photos?type=uploaded';

        } else {
            // Searching the total of photos of the current album to pagination
            $this->setTotalItems($albumId);

            $uri = "/{$albumId}/photos";

        }

        $values = $this->getResponseValues($uri);

        foreach ($values as $value) {
            $proceed = true;
            $album = $value->getField('album');

            if ($album){
                $proceed = $this->outExcludedAlbums($album->getField('name'));
            }

            if ($proceed) {
                $photo = $this->populatePhoto($value);
                $photo->link = $photo->source;

                $photos->push($photo);
            }
        }

        return $this->paginateResult($photos);
    }

    public function setSize(int $width, int $height)
    {
        $this->setFields('images');

        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @param GraphEdge $values
     * @return Collection
     */
    private function iterateAlbums(GraphEdge $values)
    {
        $excludedAlbums = config('facebook.excluded_albums') ?? [];

        $albums = $values->map(function($value) use ($excludedAlbums) {
            $out = $this->outExcludedAlbums($value->getField('name'));

            if ($out) {
                return $this->populateAlbum($value);
            } else {
                $this->totalItems -= 1;
            }
        });

        $result = array_values(array_filter($albums->asArray()));

        return collect($result);
    }

    /**
     * @param null $albumId
     */
    private function setTotalItems($albumId = null)
    {
        $params = ['fields' => 'count'];

        if (null == $albumId) {
            $params['fields'] .= ',name';
            $uri = $this->pageId . '/albums';
            $albums = $this->setRequest($uri, $params)->getDecodedBody()['data'];

            foreach ($albums as $album) {
                if ($this->outExcludedAlbums($album['name'])) {
                    $this->totalItems += $album['count'];
                }
            }

        } else {
            $uri = '/' . $albumId;
            $this->totalItems = $this->setRequest($uri, $params)->getDecodedBody()['count'];
        }
    }
}