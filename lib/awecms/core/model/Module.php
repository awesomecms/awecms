<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:48
 */

namespace awecms\core\model;

use awecms\App;
use awecms\model\Model;
use awecms\module\RestModule;
use awecms\router\Request;
use awecms\router\Response;

class Module extends RestModule
{

    public $slug = "/model/{model}/{id}";
    private $mapping;

    public function __construct(App $app)
    {
        $app->router->get("/model/_list", array($this, "listModels"));
        $app->router->get("/model/{model}/_schema", array($this, "getSchema"));
        parent::__construct($app);

    }

    public function initialize()
    {
        $this->mapping = array();
        foreach ($this->app->getModels() as $model) {
            $class = new \ReflectionClass($model);
            $this->mapping[strtolower($class->getShortName())] = $model;
        }
    }

    public function listModels(Request $request, Response $response)
    {
        $json = array_keys($this->mapping);
        return $response->setStatus(200)->setType(Response::TYPE_JSON)->setBody($json);
    }


    public function getSchema(Request $request, Response $response)
    {
        $json = call_user_func(array($this->mapping[$request->getAttribute("model")], "getSchema"));
        return $response->setStatus(200)->setType(Response::TYPE_JSON)->setBody($json);
    }
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function doGet(Request $request, Response $response): Response
    {

        $json = [];
        if (!$this->checkModel($request)) {
            return $response->setStatus(404)->setType(Response::TYPE_JSON)->setBody(array("error" => "model not found"));
        }
        $model = $request->getAttributes()["model"];
        if (!isset($request->getAttributes()["id"]) || $request->getAttributes()["id"] == "") {
            $res = call_user_func(array($this->mapping[$model], "getAll"));
            /**
             * @var $model Model
             */
            foreach ($res as $model) {
                $json[] = $model->toArray();
            }

        } else {
            $json = new $this->mapping[$model]($request->getAttributes()["id"]);
        }
        $response->setStatus(200)->setType(Response::TYPE_JSON)->setBody($json);
        return $response;
    }

    private function checkModel(Request $request)
    {
        if (!isset($this->mapping[$request->getAttributes()["model"]])) {
            return false;
        }
        return true;
    }

    public function doPost(Request $request, Response $response): Response
    {
        if (!$this->checkModel($request)) {
            return $response->setStatus(404)->setType(Response::TYPE_JSON)->setBody(array("error" => "model not found"));
        }
        $model = $request->getAttributes()["model"];

        /**
         * @var $model Model
         */
        $model = new $this->mapping[$model](null);
        $model->fromArray($request->getDecodedBody());
        $model->persist();
        return $response->setType(Response::TYPE_JSON)->setBody($model);
    }

    public function doPut(Request $request, Response $response): Response
    {
        if (!$this->checkModel($request)) {
            return $response->setStatus(404)->setType(Response::TYPE_JSON)->setBody(array("error" => "model not found"));
        }
        $model = $request->getAttributes()["model"];

        if (isset($request->getAttributes()["id"]) && $request->getAttributes()["id"] != "") {
            /**
             * @var $model Model
             */
            $model = new $this->mapping[$model]($request->getAttributes()["id"]);
            $model->fromArray($request->getDecodedBody());
            $model->persist();
            return $response->setType(Response::TYPE_JSON)->setBody($model);
        }
    }

    public function doDelete(Request $request, Response $response): Response
    {
        if (!$this->checkModel($request)) {
            return $response->setStatus(404)->setType(Response::TYPE_JSON)->setBody(array("error" => "model not found"));
        }
        $model = $request->getAttributes()["model"];

        if (isset($request->getAttributes()["id"]) && $request->getAttributes()["id"] != "") {
            /**
             * @var $model Model
             */
            $model = new $this->mapping[$model]($request->getAttributes()["id"]);
            $model->delete();
            return $response->setType(Response::TYPE_JSON)->setBody(array("msg" => "success"));
        }
    }
}