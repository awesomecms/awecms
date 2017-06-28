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
 * @engine awecms\storage\FileStorageEngine
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