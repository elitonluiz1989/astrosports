<?php

namespace App\Models\Abstracts;


abstract class FacebookData
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @param $attr
     * @param $value
     */
    public function __set($attr, $value) {
        $this->$attr = $value;
        $this->attributes[$attr] = $value;
    }

    /**
     * @param $attr
     */
    public function __unset($name)
    {
        unset($this->attributes[$name]);
    }

    /**
     * @param $attr
     * @return mixed|null
     */
    public function __get($attr) {
        $prop = ucfirst(strtolower($attr));
        $methodName = 'get' . $prop . 'Attribute';

        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        } else {
            return $this->attributes[$attr];
        }
    }
}