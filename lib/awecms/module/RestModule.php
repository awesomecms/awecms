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
use awecms\router\Response;

/**
 * Class RestModule
 * Variation of the APIModule which provides a REST-like interface
 * @package awecms\module
 */
abstract class RestModule extends APIModule
{

    public $slug;

    public function __construct(App $app) {
        parent::__construct($app);
        $this->app->router->get($this->slug, (array($this,"doGet")));
        $this->app->router->post($this->slug, (array($this,"doPost")));
        $this->app->router->put($this->slug, (array($this,"doPut")));
        $this->app->router->delete($this->slug, (array($this,"doDelete")));
    }

    abstract public function doGet(Request $request,Response $response):Response;

    abstract public function doPost(Request $request,Response $response):Response;

    abstract public function doPut(Request $request,Response $response):Response;

    abstract public function doDelete(Request $request,Response $response):Response;


}