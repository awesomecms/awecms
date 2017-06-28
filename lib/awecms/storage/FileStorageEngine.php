<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 00:16
 */

namespace awecms\storage;


use awecms\model\Model;

class FileStorageEngine extends StorageEngine
{

    public function createSchema()
    {

    }

    public function createModel(array $model)
    {
        $id = uniqid();
        $model["id"] = $id;
        if (!is_dir($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "data/" . $this->schema . "/")) {
            mkdir($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "data/" . $this->schema . "/", 0777, true);
        }
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "data/" . $this->schema . "/" . $id. ".json", json_encode($model));
        return $id;
    }

    public function updateModel(array $model)
    {
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "data/" . $this->schema . "/" . $model["id"] . ".json", json_encode($model));
    }

    public function deleteModel(array $model)
    {
        unlink($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "data/" . $this->schema . "/" . $model["id"] . ".json");
    }

    public function getModel($id): array
    {
        return json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "data/" . $this->schema . "/" . $id . ".json"), true);
    }

    public function query(array $params)
    {
        // TODO: Implement query() method.
    }
}