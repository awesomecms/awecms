<?php

/**
 * Project: awecms.
 * User: jens
 * Date: 28.06.17
 * Time: 07:44
 */


namespace modules\frontend\models;
use awecms\model\Model;

/**
 * Class Article
 * @engine modules\mysqlengine\MySQLStorageEngine
 * @package modules\frontend\models
 */
class Article extends Model {

    /** @type string */
    public $title;

    /**
     * @type date
     */
    public $publishedAt;

    /**
     * @type string
     */
    public $text;

    public function __construct($id = null)
    {
        parent::__construct($id);
        if ($id == null) {
            $this->publishedAt = date("Y-m-d H:i:s");
        }
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

}