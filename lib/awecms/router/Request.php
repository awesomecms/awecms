<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 21:00
 */

namespace awecms\router;


class Request {


    private $header;
    private $method;
    private $uri;
    private $body;
    private $protocol;
    private $path;
    private $query;
    private $attributes;

    function __construct($method, array $header, $uri, $body, $protocol){

        $this->method = $method;
        $this->header = $header;
        $this->uri = $uri;
        $this->body = $body;
        $this->protocol = $protocol;
        $res = parse_url($this->getUri());
        $this->path = $res["path"];
        $this->query = $res["query"] ?? null;

    }

    static function fromCurrentRequest()
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $uri = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $body = file_get_contents('php://input', 'r+');
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? str_replace('HTTP/', '', $_SERVER['SERVER_PROTOCOL']) : '1.1';
        return new Request($method,$headers,$uri,$body,$protocol);
    }

    public function getPath(){
        return $this->path;
    }

    public function getQueryParameters()
    {
        $res = [];
        $params = explode("&",$this->getQuery());
        foreach ($params as $param){
            $split = explode("=",$param);
            if(count($split)>1){
                $res[$split[0]] = urldecode($split[1]);
            } else {
                $res[$split[0]] = true;
            }
        }
        return $res;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }


    public function setAttributes($attr){
        $this->attributes = $attr;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}