<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 03:03
 */

namespace modules\core\backend;


use awecms\App;
use awecms\model\Model;
use awecms\router\Request;
use awecms\router\Response;

class Module extends \awecms\module\Module
{

    public $slug = "/backend";

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->app->loadModel("modules\\core\\models\\User");
        $this->app->router->get($this->slug,array($this,"index"));
    }
    public function index(Request $request, Response $response){
        return $response->setBody(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/backend/index.html"));
    }

}