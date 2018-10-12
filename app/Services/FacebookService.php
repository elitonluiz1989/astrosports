<?php

namespace App\Services;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class FacebookService
{
    /**
     * @var Facebook
     */
    private $facebook;

    public function __construct()
    {
        $config = config('facebook.graph_settings');

        $this->facebook = new Facebook($config);
    }

    /**
     * @param $name
     * @param $arguments
     * @return string
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->facebook, $name)) {
            try {
                return $this->facebook->$name(...$arguments);
            } catch (FacebookResponseException $e) {
                echo  'Facebook Response Exception: ' . $e->getMessage();
                exit;
            } catch (FacebookSDKException $e) {
                echo  'Facebook SDK Exception: ' . $e->getMessage();
                exit;
            }

        }
    }
}