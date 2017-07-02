<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:11
 */

namespace awecms\module;

use awecms\acl\RoleManager;
use awecms\App;
use awecms\util\Util;

/**
 * Class Module
 * BaseModule
 * @package awecms\module
 */
abstract class Module {

    public $slug;

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;

    }

    public function check(string $role)
    {

    }

    public function initialize(){}


}