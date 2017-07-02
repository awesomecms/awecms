<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 30.06.17
 * Time: 23:55
 */

namespace modules\mysqlengine;


use modules\frontend\models\Article;

class SchemaCreator
{

    private $mapping = array(
        "string" => "VARCHAR(255)",
        "int" => "INT",
        "date" => "DATE",
        "primaryKey" => "int NOT NULL AUTO_INCREMENT",
        "bool" => "TINYINT",
        "text" => "TEXT",
    );

    public function mkCreateSQL($name, $schema)
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . strtolower($name) . " (\n";
        foreach ($schema as $field) {
            $sql .= $field["name"] . " " . $this->mapping[$field["type"]] . ",\n";
        }
        $sql .= "PRIMARY KEY (" . $this->getPrimary($schema) . ")\n";
        $sql .= ");";
        return $sql;
    }

    private function getPrimary($schema)
    {
        foreach ($schema as $field) {
            if ($field["type"] === "primaryKey") {
                return $field["name"];
            }
        }
    }


}