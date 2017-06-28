<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:48
 */

namespace modules\frontend;


use awecms\module\RestModule;
use awecms\router\Request;
use awecms\router\Response;
use modules\frontend\models\Article;

class Module extends RestModule {

    public $slug = "/frontend/{id}";

    public function doGet(Request $request, Response $response): Response
    {
        $response->setType(Response::TYPE_JSON)->setBody(array(array("yolo"=>"test"),array("yolo"=>"test")));
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
}