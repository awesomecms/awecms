<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 03:03
 */

namespace modules\core;


use awecms\App;
use awecms\model\Model;

class Module extends \awecms\module\Module
{

    public function __construct(App $app)
    {
        parent::__construct($app);
        //load modules models
        $this->app->loadModel("modules\\core\\models\\User");
        //Load submodules of this one
        $this->app->loadModule("modules\\core\\model\\Module");
        $this->app->loadModule("modules\\core\\backend\\Module");
        $this->app->loadModule("modules\\core\\auth\\Module");
    }

}