<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 28.06.17
 * Time: 23:10
 */

namespace awecms\router;


class Response
{

    const TYPE_JSON = "text/json";
    const TYPE_HTML = "text/html";

    private $status = 200;
    private $body = "";
    private $type = self::TYPE_HTML;

    /**
     * @param mixed $body
     * @return static
     */
    public function setBody($body)
    {

        switch (true) {
            case $this->type == self::TYPE_JSON:
                $this->body = json_encode($body);
                break;
            default:
                $this->body = $body;
                break;
        }

        return $this;
    }

    /**
     * @param integer $status
     * @return static
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param mixed $type
     * @return static
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    public function send()
    {
        header("content-type:" . $this->type);
        http_response_code($this->status);
        echo $this->body;
    }

    /**
     * Response constructor
     */
    public function __construct()
    {

    }


}