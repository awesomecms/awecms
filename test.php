<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 23:47
 */

$re = '/\{(.*)\}/U';
$str = '/test/{test}/{lol}';
$str2 = '/test/asasas';

preg_replace($re, "(.*)", $str);

// Print the entire match result
$pattern = (preg_replace($re, "(?<$1>(.*))", $str));
$pattern = str_replace("/","\\/",$pattern);
var_dump($pattern);
var_dump(preg_match("/".$pattern."/", $str2,$math));

var_dump($math);