<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 03:03
 */

namespace awecms\core;


use awecms\App;
use awecms\model\Model;

class Module extends \awecms\module\Module
{

    public function __construct(App $app)
    {
        parent::__construct($app);
        //load modules models
        $this->app->loadModel("awecms\\core\\models\\User");
        $this->app->loadModel("awecms\\core\\models\\Role");
        //Load submodules of this one
        $this->app->loadModule("awecms\\core\\model\\Module");
        $this->app->loadModule("awecms\\core\\backend\\Module");
        $this->app->loadModule("awecms\\core\\auth\\Module");
    }

}