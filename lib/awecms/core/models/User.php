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

    public $username;
    public $password;
    public $realname;
    public $email;
}