<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 00:31
 */

namespace awecms\util;


class Util
{

    static public function getDocProp($prop, $docBlock)
    {
        $re = '/\@' . $prop . '\s(.+)\s/';
        preg_match($re, $docBlock, $matches);
        return $matches[1];
    }
}