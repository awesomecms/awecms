<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 23:47
 */
ini_set("display_errors",'1');
require "init.php";
$article = new \modules\frontend\models\Article("59543981dda30");

var_dump($article);
