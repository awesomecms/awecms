<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:15
 */

namespace awecms;


use awecms\module\Module;
use awecms\router\Request;
use awecms\router\Router;
use GuzzleHttp\Psr7\ServerRequest;

class App
{
    /**
     * @var $router Router
     */
    public $router;

    private $config;
    private $modules;

    public function __construct($config_url)
    {
        $this->loadConfig($config_url);
        $this->router = new Router();
    }


    public function loadModule($modname){
        /**
         * @var $module Module
         */
        $module = new $modname($this);
        $this->modules[$module->slug] = $module;
    }

    public function run(){
        $response = $this->router->execute(Request::fromCurrentRequest());
        $response->send();
    }

    private function loadConfig($config_url)
    {
        $file = file_get_contents($config_url);
        if ($file === false) {
            throw new \ErrorException("config url not valid");
        }
        $config = json_decode($file);
        if ($config !== false) {
            $this->config = $config;
        } else {
            throw new \ErrorException("config format not valid");
        }
    }


}