<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:15
 */

namespace awecms;

use awecms\config\Config;
use awecms\core\models\Session;
use awecms\core\models\User;
use awecms\module\Module;
use awecms\router\Request;
use awecms\router\Router;

/**
 * Class App
 * Main Class of aweCMS inits all modules and is the request entrypoint
 * @package awecms
 */
class App
{
    /**
     * @var $router Router
     */
    public $router;

    private $config;
    private $modules;
    private $models;

    public function __construct($config_url)
    {
        $this->loadConfig($config_url);
        $this->router = new Router();
        //Load core modules
        $this->loadModule("awecms\\core\\Module");

    }

    private function loadConfig($config_url)
    {
        $this->config = new Config($config_url);
    }

    public function loadModule($modname){
        /**
         * @var $module Module
         */
        $module = new $modname($this);
        $this->modules[$module->slug] = $module;
    }

    public function loadModel($model){
        $this->models[] = $model;
    }

    public function run(){
        // Run the initialze Module hook
        $this->initialize();
        // handle the request
        $response = $this->router->execute(Request::fromCurrentRequest());
        $response->send();
    }

    private function initialize()
    {
        /**
         * @var $module Module
         */
        foreach ($this->modules as $module){
            $module->initialize();
        }
    }

    /**
     * @return mixed
     */
    public function getModels()
    {
        return $this->models;
    }

    public function getUser(): User
    {
        return $this->user;
    }


}