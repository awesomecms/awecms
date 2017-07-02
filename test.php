<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 23:47
 */
ini_set("display_errors", '1');
require "init.php";

$schema = \awecms\core\models\User::getSchema();
$sc = new \modules\mysqlengine\SchemaCreator;
$sql = $sc->mkCreateSQL("User", $schema);
echo $sql;
$db = new \modules\mysqlengine\Database(array("host" => "mysql", "user" => "root", "password" => "root", "database" => "awecms"));
$db->query($sql);
$db->execute();


var_dump(\modules\frontend\models\Article::getAll());