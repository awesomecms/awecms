<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:11
 */

namespace awecms\module;


use awecms\App;
use awecms\router\Request;
use awecms\router\Response;

/**
 * Class APIModule
 * Variation of the base module, which prefixs every child module with /api
 * @package awecms\module
 */
abstract class APIModule extends Module
{

    public $slug;

    public function __construct(App $app) {
        parent::__construct($app);
        $this->slug = "/api".$this->slug;
    }


}