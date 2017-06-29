<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:51
 */

namespace awecms\router;


/**
 * Class Router
 * @package awecms\router
 */
class Router
{
    private $routes = array();


    public function get($pattern, $callback){
        $this->route("get",$pattern, $callback);
    }

    public function route($method, $pattern, $callback)
    {
        $this->routes[strtoupper($method)][$pattern] = $callback;
    }

    public function post($pattern, $callback){
        $this->route("post",$pattern, $callback);
    }

    public function put($pattern, $callback){
        $this->route("put",$pattern, $callback);
    }

    public function delete($pattern, $callback){
        $this->route("delete",$pattern, $callback);
    }

    public function execute(Request $url):Response
    {
        $response = new Response();
        foreach ($this->routes[$url->getMethod()] as $pattern => $callback) {
            $attr = $this->matchPattern($pattern, $url);
            if ($attr != false) {
                if(!is_bool($attr)) {
                    $url->setAttributes($attr);
                }
                return $callback($url,$response);
            }
        }
        $response->setStatus(404);
        return $response;
    }

    private function matchPattern($pattern, Request $url)
    {
        $re = '/\{(.*)\}/U';
        $pattern = (preg_replace($re, "(?<$1>(.*))", $pattern));
        $pattern = str_replace("/", "\\/", $pattern);
        $isMatch = preg_match("/" . $pattern . "/", $url->getPath(), $match);
        if ((bool)$isMatch) {
            if(count($match)>1){
                return $this->filterMatches($match);
            } else {
                return true;
            }
        }
        return false;
    }

    private function filterMatches($matches)
    {
        return array_filter($matches, function ($k) {
            return !is_int($k);
        }, ARRAY_FILTER_USE_KEY);
    }
}