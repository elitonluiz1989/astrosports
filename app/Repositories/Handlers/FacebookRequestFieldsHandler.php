<?php

namespace App\Repositories\Handlers;

use Illuminate\Support\Collection;

trait FacebookRequestFieldsHandler
{
    /**
     * @var Collection
     */
    private $fields;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param string $field
     * @return bool
     */
    public function hasField(string $field)
    {
        return $this->fields->contains($field);
    }

    /**
     * @param array|string $fields
     */
    public function setFields($fields)
    {
        $this->setFieldsCollection();

        if (is_array($fields)) {
            $this->fields = $this->fields->concat($fields);
        } else {
            if (!$this->fields->contains($fields)) {
                $this->fields->push($fields);
            }
        }
    }

    public function removeField(string $field)
    {
        $this->fields = $this->fields->filter(function($item) use($field) {
            return $item != $field;
        });
    }

    private function setFieldsCollection()
    {
        if (null == $this->fields) {
            $this->fields = collect([]);
        }
    }
}