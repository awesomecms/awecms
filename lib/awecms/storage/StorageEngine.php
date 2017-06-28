<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 00:10
 */

namespace awecms\storage;


use awecms\model\Model;

abstract class StorageEngine
{

    public $schema;

    abstract public function createSchema();
    abstract public function createModel(array $model);
    abstract public function updateModel(array $model);
    abstract public function deleteModel(array $model);
    abstract public function getModel($id):array ;
    abstract public function query(array $params);

    static function getEngine($engine):StorageEngine{
        if(class_exists($engine,true)){
            return new $engine();
        } else {
            throw new \ErrorException("StorageEngine $engine not found");
        }
    }

}