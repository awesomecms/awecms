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

/**
 * Class Model
 * Abstract class which provides a base model for interacting with StorageEngines
 * @package awecms\model
 */
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

    public function load()
    {
        $this->fromArray($this->storageEngine->getModel($this->id));
    }

    public function fromArray($model)
    {

        foreach ($model as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public static function getAll()
    {
        $storageEngine = StorageEngine::getEngine(self::getEngine());
        $class = new \ReflectionClass(get_called_class());
        $storageEngine->schema = strtolower($class->getShortName());
        $res = $storageEngine->query(array());
        $list = [];
        foreach ($res as $model) {
            /**
             * @var $m Model
             */
            $class = get_called_class();
            $m = new $class();
            $m->fromArray($model);
            $list[] = $m;
        }
        return $list;
    }

    public function persist(){
        if($this->createMode){
            $this->storageEngine->createModel($this->toArray());
        } else {
            $this->storageEngine->updateModel($this->toArray());
        }

    }

    public function toArray()
    {
        $res = [];
        $fields = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($fields as $field) {
            $res[$field->getName()] = $field->getValue($this);
        }
        return $res;
    }

    public function delete(){
        $this->storageEngine->deleteModel($this->toArray());

    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    public function toJSON()
    {
        return json_encode($this->toArray());
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


}