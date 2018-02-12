<?php

namespace App\Repositories\Handlers;


trait FacebookPhotoDataHandler
{
    /**
     * @var \App\Models\FacebookPhoto
     */
    public $facebookPhoto;

    /**
     * @param $values
     * @param string $field
     * @return \App\Models\FacebookPhoto
     */
    public function subFieldsHandler($values, string $field)
    {
        list($subFieldName, $subFieldItems) = explode('{', $field);

        $subFields = str_replace('}', '', $subFieldItems);
        $subFields = explode(',', $subFields);

        $subValues = $values->getField($subFieldName);

        foreach ($subFields as $subField) {
            $fieldName = $subFieldName . ucfirst($subField);

            $this->facebookPhoto->$fieldName = $subValues->getField($subField);
        }

        return $this->facebookPhoto;
    }


    /**
     * @param $images
     * @param string $defaultSource
     */
    public function imageFieldHandler($images, string $defaultSource)
    {
        foreach ($images as $image) {
            if ($image->getField('width') == $this->width && $image->getField('height') == $this->height) {
                $this->facebookPhoto->source = $image->getField('source');
                break;
            }
        }


        if (empty($this->facebookPhoto->source)) {
            $this->facebookPhoto->source = $defaultSource;
        }
    }
}