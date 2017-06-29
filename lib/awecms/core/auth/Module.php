<?php
namespace awecms\core\auth;
use awecms\App;
use awecms\module\APIModule;
use awecms\router\Request;
use awecms\router\Response;

/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 03:44
 */

class Module extends APIModule{

    public $slug = "/auth";

    function __construct(App $app)
    {
        parent::__construct($app);
        $this->app->router->get($this->slug."/login",array($this,"login"));
    }

    public function login(Request $request, Response $response){
            return $response->setBody("login");
    }
}