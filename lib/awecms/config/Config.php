<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 30.06.17
 * Time: 23:38
 */

namespace awecms\config;


class Config
{
    private $url;
    private $config;

    function __construct($url)
    {
        $this->url = $url;
        $this->load();

    }

    private function load()
    {
        $file = file_get_contents($this->url);
        if ($file === false) {
            throw new \ErrorException("config url not valid");
        }
        $config = json_decode($file, true);
        if ($config !== false) {
            $this->config = $config;
        } else {
            throw new \ErrorException("config format not valid");
        }
    }


    public function get($field)
    {
        return $this->config[$field];
    }


}