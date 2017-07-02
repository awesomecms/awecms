<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 30.06.17
 * Time: 23:51
 */

namespace modules\mysqlengine;


use awecms\storage\StorageEngine;
use modules\mysqlengine\Database;

class MySQLStorageEngine extends StorageEngine
{

    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = new Database($this->config->get("storage")["MySQLStorageEngine"]);

    }

    public function createSchema()
    {

    }

    public function createModel(array $model)
    {
        $sqladd = [];
        unset($model["id"]);
        $sql = "INSERT INTO " . $this->schema . " SET ";
        foreach ($model as $col => $val) {
            $sqladd[] = $col . "='" . $val . "'";
        }
        $sql .= join(",", $sqladd);
        $this->db->query($sql);
        $this->db->execute();
    }

    public function updateModel(array $model)
    {
        $sql = "UPDATE INTO " . $this->schema . " SET ";
        $id = $model["id"];
        unset($model["id"]);
        foreach ($model as $col => $val) {
            $sqladd[] = $col . "='" . $val . "'";
        }
        $sql .= join(",", $sqladd);
        $sql .= " WHERE id ='" . intval($id, 10) . "'";
        $this->db->query($sql);
        $this->db->execute();
    }

    public function deleteModel(array $model)
    {
        $sql = "DELETE FROM " . $this->schema . " WHERE id ='" . intval($model["id"], 10) . "'";
        $this->db->query($sql);
        $this->db->execute();
    }

    public function getModel($id): array
    {
        $sql = "SELECT * FROM " . $this->schema . " WHERE id ='" . intval($id, 10) . "'";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->getOne();
    }

    public function query(array $params)
    {
        $sql = "SELECT * FROM " . $this->schema;
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->getAll();
    }
}