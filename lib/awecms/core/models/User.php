<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 03:01
 */

namespace awecms\core\models;


use awecms\model\Model;

/**
 * Class User
 * @engine awecms\storage\FileStorageEngine
 * @package awecms\core\models
 */
class User extends Model
{
    /**
     * @var
     * @type string
     */
    public $username;
    /**
     * @var
     * @type string
     */
    public $password;
    /**
     * @var
     * @type string
     */
    public $realname;
    /**
     * @var
     * @type string
     */
    public $email;
}