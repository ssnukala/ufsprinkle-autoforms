<?php

/**
 * UserFrosting (http://www.srinivasnukala.com)
 *
 * @link      https://github.com/ssnukala/ufsprinkle-sndbforms
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala

 * */

namespace UserFrosting\Sprinkle\SnDbforms\Model;

use \Illuminate\Database\Capsule\Manager as Capsule;
use UserFrosting\Sprinkle\Core\Model\UFModel;

class AutoFormSource extends UFModel {

    protected $table = "undefined";
    protected $fillable = [];

    static function init($table, $fillable) {
        $this->table = $table;
        $this->$fillable = $fillable;
    }

}
