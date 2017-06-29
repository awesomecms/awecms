<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 04:52
 */

namespace awecms\acl;


use awecms\core\models\User;

/**
 * Class RoleManager
 * Provides functions to check permissions and
 * @package awecms\acl
 */
class RoleManager
{

    static function check(User $user, $role)
    {
        var_dump($role);
    }

}