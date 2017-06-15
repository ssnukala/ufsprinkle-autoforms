<?php

/**
 * UserFrosting (http://www.srinivasnukala.com)
 *
 * @link      https://github.com/ssnukala/ufsprinkle-autoforms
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala

 * */

namespace UserFrosting\Sprinkle\AutoForms\Database\Models;

use \Illuminate\Database\Capsule\Manager as Capsule;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

class AutoFormSource extends Model {

    protected $table = "undefined";
    protected $fillable = [];

    static function init($table, $fillable) {
        $this->table = $table;
        $this->$fillable = $fillable;
    }

}
