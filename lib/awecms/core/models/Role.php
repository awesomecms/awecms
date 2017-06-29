<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 29.06.17
 * Time: 04:46
 */

namespace awecms\core\models;


use awecms\model\Model;

/**
 *
 * Class Role
 * @engine awecms\storage\FileStorageEngine
 * @package awecms\core\models
 */
class Role extends Model
{

    public $role_name;
    public $role_display_name;

}