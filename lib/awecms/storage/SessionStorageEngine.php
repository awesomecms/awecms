<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 00:16
 */

namespace awecms\storage;


use awecms\model\Model;

class SessionStorageEngine extends StorageEngine
{

    public function createSchema()
    {

    }

    public function createModel(array $model)
    {

        $_SESSION[$model["id"]] = serialize($model);
        return $model["id"];
    }

    public function updateModel(array $model)
    {

        $_SESSION[$model["id"]] = serialize($model);

    }

    public function deleteModel(array $model)
    {
        unset($_SESSION[$model["id"]]);
    }

    public function query(array $params)
    {
        $res = [];
        foreach ($_SESSION as $id) {
            $res[] = $this->getModel($id);
        }

        return $res;
    }

    public function getModel($id): array
    {
        return unserialize($_SESSION[$id]);
    }
}