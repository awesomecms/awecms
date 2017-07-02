<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 00:10
 */

namespace awecms\storage;


use awecms\config\Config;
use awecms\model\Model;

/**
 * Class StorageEngine
 * Describes which methods a StorageEngine has to implement and provides helper functions
 * @package awecms\storage
 */
abstract class StorageEngine
{

    public $schema;
    protected $config;

    function __construct()
    {
        $this->config = new Config(CONFIG_URL);
    }

    static function getEngine($engine): StorageEngine
    {
        if (class_exists($engine, true)) {
            return new $engine();
        } else {
            throw new \ErrorException("StorageEngine $engine not found");
        }
    }

    abstract public function createSchema();

    abstract public function createModel(array $model);

    abstract public function updateModel(array $model);

    abstract public function deleteModel(array $model);

    abstract public function getModel($id):array ;

    abstract public function query(array $params);

}