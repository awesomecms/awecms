<?php
/**
 * Created by PhpStorm.
 * User: jens
 * Date: 27.06.17
 * Time: 17:56
 */

require "init.php";

//init app
$app = new \awecms\App(CONFIG_URL);

$app->loadModule("modules\\frontend\\Module");

$app->router->get("/test/{test}/{lol}",function (\awecms\router\Request $request){
    var_dump($request);
});

$app->router->post("/test/{test}/{lol}",function (\awecms\router\Request $request){
    var_dump($request);
});


$app->router->put("/test/{test}/{lol}",function (\awecms\router\Request $request){
    var_dump($request);
});


$app->router->delete("/test/{test}/{lol}",function (\awecms\router\Request $request){
    var_dump($request);
});

$app->run();