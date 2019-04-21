<?php

namespace App\Repositories\Abstracts;

use App\Handlers\Facebook\FacebookPhotoDataHandler;
use App\Handlers\Facebook\FacebookRequestHandler;
use App\Models\FacebookPhoto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class FacebookBase extends FacebookRequestHandler
{
    use FacebookPhotoDataHandler;

    /**
     * @var int
     */
    protected $height = 0;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $width = 0;

    /**
     * @param $values
     * @return FacebookPhoto
     */
    protected function populatePhoto($values)
    {
        $this->facebookPhoto = new FacebookPhoto();

        //Remove the source of fields var to prevent override of wanted image, more bellow.
        if ($this->hasField('images')) {
            $this->removeField('source');
        }

        $fields = $this->getFields();

        foreach ($fields as $field) {
            if (strpos($field, '{')) {
                $this->subFieldsHandler($values, $field);
            } else if ($field == 'images' && $this->width > 0 && $this->height > 0) {
                $images = $values->getField('images');
                $source = $values->getField('source');

                $this->imageFieldHandler($images, $source);
            } else {
                $this->facebookPhoto->$field = $values->getField($field);
            }
        }

        return $this->facebookPhoto;
    }

    /**
     * @param $values
     * @return FacebookPhoto
     */
    protected function populateAlbum($values)
    {
        $album = $this->populatePhoto($values);

        if ($this->hasField('cover_photo')) {
            $album = $this->setCoverAlbum($album);
        }

        return $album;
    }

    /**
     * @param FacebookPhoto $album
     * @return FacebookPhoto
     */
    protected function setCoverAlbum(FacebookPhoto $album)
    {
        $response = $this->facebook->get('/' . $album->cover_photo['id']. '?fields=source');
        $cover = $response->getGraphNode();
        $album->source = $cover->getField('source');

        unset($album->cover_photo);

        return $album;
    }

    /**
     * @param Collection $items
     * @return LengthAwarePaginator|Collection
     */
    public function paginateResult(Collection $items)
    {
        if ($this->isOffsetPagination) {
            $paginator = new LengthAwarePaginator($items, $this->totalItems, $this->limit);

            if (empty($this->path) || null === $this->path) {
                return $paginator;
            } else {
                return $paginator->setPath($this->path);
            }
        } else {
            return $items;
        }
    }

    protected function outExcludedAlbums(string $name)
    {
        $excludeAlbums = config('facebook.excluded_albums');

        return !in_array($name, $excludeAlbums);
    }
}