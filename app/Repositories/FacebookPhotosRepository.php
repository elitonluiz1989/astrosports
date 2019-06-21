<?php
namespace App\Repositories;

use App\Handlers\Facebook\FacebookResponseHandler;
use App\Repositories\Abstracts\FacebookBase;
use App\Repositories\Contracts\PhotosRepositoryInterface;
use App\Services\FacebookService;
use Facebook\GraphNodes\GraphEdge;
use Illuminate\Support\Collection;

class FacebookPhotosRepository extends FacebookBase implements PhotosRepositoryInterface
{
    /**
     * @var array
     */
    public $fields;

    private $legacyPhotos;

    public function __construct(FacebookService $facebook,
                                LegacyPhotosRepository $legacyPhotos) {
        parent::__construct($facebook);

        $this->legacyPhotos = $legacyPhotos;
    }

    /**
     * @param $albumId
     * @return \Facebook\GraphNodes\GraphAlbum
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getAlbum($albumId)
    {
        $params = ['fields' => 'name'];
        $album = $this->setRequest($albumId, $params);
        return $album->getGraphAlbum();
    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator|Collection
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getAlbums()
    {
        $this->verifyFields(['id', 'name']);

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
        // Set fields to photos search
        $this->verifyFields(['id', 'name', 'source', 'album{id,name}']);

        if (null == $albumId) {
            $this->setTotalItems();

            $uri = $this->pageId . '/photos?type=uploaded';
            $this->path = config('photos.url.photos');

        } else {
            // Searching the total of photos of the current album to pagination
            $this->setTotalItems($albumId);

            $uri = "/{$albumId}/photos";
            $this->path = config('photos.url.album') . $albumId;
        }

        $values = $this->getResponseValues($uri);

        $response = new FacebookResponseHandler();
        $response->paging->data = $values->getMetaData()["paging"];
        $response->paging->baseUrl = $this->path;

        foreach ($values as $value) {
            $proceed = true;
            $album = $value->getField('album');

            if ($album){
                $proceed = $this->outExcludedAlbums($album->getField('name'));
            }

            if ($proceed) {
                $photo = $this->populatePhoto($value);
                $photo->link = $photo->source;

                $response->items->push($photo);
            }
        }

        return ($this->isOffsetPagination) ? $this->paginateResult($response->items) : $response;
    }

    /**
     * @param int $width
     * @param int $height
     */
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
        $albums = $values->map(function($value) {
            $out = $this->outExcludedAlbums($value->getField('name'));

            if ($out) {
                return $this->populateAlbum($value);
            } else {
                $this->totalItems -= 1;
            }
        });

        $result = array_values(array_filter($albums->asArray()));

        $legacyAlbums = $this->legacyPhotos->getAlbums();
        $this->totalItems += $legacyAlbums->count();

        $finalAlbums = $legacyAlbums->merge($result);

        return $finalAlbums;
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

    /**
     * @param array $defaultFields
     */
    private function verifyFields(array $defaultFields)
    {
        $fields = $this->fields ?? $defaultFields;
        $this->setFields($fields);
    }
}