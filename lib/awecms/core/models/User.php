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
 * @engine modules\mysqlengine\MySQLStorageEngine
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

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRealname()
    {
        return $this->realname;
    }

    /**
     * @param mixed $realname
     */
    public function setRealname($realname)
    {
        $this->realname = $realname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}