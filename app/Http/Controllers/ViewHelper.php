<?php

namespace App\Http\Controllers;

class ViewHelper {
    private $file;
    private $data;

    public function __construct() {
        $this->data = [
            'showSidebar' => true,
            'page' => 1
        ];
    }

    public function setVar($key, $value) {
        $this->data[$key] = $value;
    }

    public function getVar($key) {
        return $this->data[$key];
    }

    public function render() {
        $view = $this->data['view'];
        unset($this->data['view']);

        return view($view, $this->data);
    }
}
