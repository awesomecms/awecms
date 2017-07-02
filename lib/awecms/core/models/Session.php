<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 02.07.17
 * Time: 16:46
 */

namespace awecms\core\models;

use awecms\model\Model;

/**
 * Class Session
 * @engine awecms\storage\SessionStorageEngine
 * @package awecms\core\models
 */
class Session extends Model
{

    /**
     * @var $data mixed
     */
    public $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

}