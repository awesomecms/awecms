<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 20:52
 */

require "vendor/autoload.php";

error_reporting(E_ALL);

define("CONFIG_URL","http://config.laur.me/v2/keys");
define('CLASS_DIR', 'lib/');
define('MODULES_DIR', 'modules/');

// Add your class dir to include path
set_include_path(__DIR__ . "/" . CLASS_DIR);
set_include_path(__DIR__ . "/" . MODULES_DIR);
// Use default autoload implementation
spl_autoload_extensions(".php");

spl_autoload_register(function ($name) {
    $fileName = CLASS_DIR.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $name).'.php';
    if (file_exists($fileName)) {
        require_once $fileName;
    } else {
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $name).'.php';
        if (file_exists($fileName)) {
            require_once $fileName;
        }
    }
});