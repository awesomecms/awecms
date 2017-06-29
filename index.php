<?php
/**
 * Created by PhpStorm.
 * User: jens
 * Date: 27.06.17
 * Time: 17:56
 */

require "init.php";
ini_set("display_errors",1);
//init app
$app = new \awecms\App(CONFIG_URL);

$app->loadModule("modules\\core\\Module");
$app->loadModule("modules\\frontend\\Module");
$app->run();