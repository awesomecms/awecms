<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:48
 */

namespace modules\core\model;


use awecms\App;
use awecms\model\Model;
use awecms\module\RestModule;
use awecms\router\Request;
use awecms\router\Response;

class Module extends RestModule {

    public $slug = "/model/{model}/{id}";
    private $mapping;

    public function __construct(App $app)
    {
        parent::__construct($app);

    }

    public function initialize(){
        $this->mapping = array();
        foreach ($this->app->getModels() as $model) {
            $class = new \ReflectionClass($model);
            $this->mapping[strtolower($class->getShortName())] = $model;
        }
    }

    public function doGet(Request $request, Response $response): Response
    {
        if(!$this->checkModel($request)){
            return $response->setStatus(404)->setType(Response::TYPE_JSON)->setBody(array("error"=>"model not found"));
        }
        $json =[];
        $model = $request->getAttributes()["model"];
        if(!isset($request->getAttributes()["id"]) || $request->getAttributes()["id"]==""){
            $res = call_user_func(array($this->mapping[$model],"getAll"));
            /**
             * @var $model Model
             */
            foreach ($res as $model){
                $json[] = array("id"=>$model->getId());
            }

        } else {
            $json = new $this->mapping[$model]($request->getAttributes()["id"]);
        }
        $response->setType(Response::TYPE_JSON)->setBody($json);
        return $response;
    }

    public function doPost(Request $request, Response $response): Response
    {
        // TODO: Implement doPost() method.
    }

    public function doPut(Request $request, Response $response): Response
    {
        // TODO: Implement doPut() method.
    }

    public function doDelete(Request $request, Response $response): Response
    {
        // TODO: Implement doDelete() method.
    }

    private function checkModel(Request $request) {
        if(!isset($this->mapping[$request->getAttributes()["model"]])){
            return false;
        }
        return true;
    }
}