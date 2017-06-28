<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:00
 */

namespace awecms\model;


use awecms\storage\FileStorageEngine;
use awecms\storage\StorageEngine;
use awecms\util\Util;
use ReflectionObject;
use ReflectionProperty;

abstract class Model {

    public $id;
    private $createMode;
    private $storageEngine;

    public function __construct($id = null)
    {
        $this->storageEngine = StorageEngine::getEngine(self::getEngine());
        $class = new \ReflectionClass(get_called_class());
        $this->storageEngine->schema = strtolower($class->getShortName());
        if ($id==null){
            $this->createMode = true;
        } else {
            $this->id = $id;
            $this->load();
        }
    }

    private static function getEngine()
    {
        $class = new \ReflectionClass(get_called_class());
        $engine = Util::getDocProp('engine',$class->getDocComment());
        return $engine;
    }

    public function persist(){
        if($this->createMode){
            $this->storageEngine->createModel($this->toArray());
        } else {
            $this->storageEngine->updateModel($this->toArray());
        }

    }

    public function delete(){

    }

    public function load(){
        $this->fromArray($this->storageEngine->getModel($this->id));
    }

    private function getFields(){
        $res = [];
        $fields = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($fields as $field) {
            $res[strtolower($field->getDeclaringClass()->getShortName())][] = array(
              "name" => $field->getName(),
              "type" => Util::getDocProp('type',$field->getDocComment())
            );
        }

        return $res;
    }


    public function toArray(){
        $res = [];
        $fields = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($fields as $field) {
            $res[$field->getName()] = $field->getValue($this);
        }
        return $res;
    }

    public function toJSON(){
        return json_encode($this->toArray());
    }

    public static function findById(int $id){
        $storageEngine = StorageEngine::getEngine(self::getEngine());
        $class = new \ReflectionClass(get_called_class());
        $storageEngine->schema = strtolower($class->getShortName());
        $storageEngine->query(array("id"=>$id));
    }

    private function fromArray($model){

        foreach ($model as $k => $v){
            $this->{$k} = $v;
        }
    }


}