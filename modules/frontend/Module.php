<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:48
 */

namespace modules\frontend;


use awecms\App;
use awecms\router\Request;
use awecms\router\Response;

class Module extends \awecms\module\Module {

    public $slug = "^/$";

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->app->router->get($this->slug,array($this,"index"));
        $this->app->loadModel("modules\\frontend\\models\\Article");
    }

    public function index(Request $request, Response $response): Response
    {
     return $response->setBody(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/frontend/index.html"));
    }
}