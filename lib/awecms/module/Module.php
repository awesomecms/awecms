<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 27.06.17
 * Time: 18:11
 */

namespace awecms\module;

use awecms\App;

abstract class Module {

   public $slug;

   protected $app;
    public function __construct(App $app) {
        $this->app = $app;
    }

    public function initialize(){}

}