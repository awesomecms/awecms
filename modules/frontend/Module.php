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
use modules\frontend\models\ArticleModel;

class Module extends RestModule {

    public $slug = "/frontend/{id}";


    public function doGet(Request $request)
    {
        $artice = new ArticleModel();
    }

    public function doPost(Request $request)
    {
        echo $request->getMethod()." ". $this->slug;
        var_dump($request->getAttributes());
    }

    public function doPut(Request $request)
    {
        echo $request->getMethod()." ". $this->slug;
    }

    public function doDelete(Request $request)
    {
        echo $request->getMethod()." ". $this->slug;
    }
}