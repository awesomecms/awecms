<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:11
 */

namespace awecms\module;


use awecms\App;
use awecms\router\Request;

abstract class RestModule extends Module
{

    public $slug;
    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->app->router->get($this->slug, (array($this,"doGet")));
        $this->app->router->post($this->slug, (array($this,"doPost")));
        $this->app->router->put($this->slug, (array($this,"doPut")));
        $this->app->router->delete($this->slug, (array($this,"doDelete")));
    }

    abstract public function doGet(Request $request);

    abstract public function doPost(Request $request);

    abstract public function doPut(Request $request);

    abstract public function doDelete(Request $request);


}