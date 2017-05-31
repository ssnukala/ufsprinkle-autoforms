<?php
/**
 * SN DB Forms (http://www.srinivasnukala.com)
 *
 * @link      https://github.com/ssnukala/ufsprinkle-sndbforms/
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 */

namespace UserFrosting\Sprinkle\SnDbForms\Model\Migrations\v400;

use UserFrosting\System\Bakery\Migrations\UFMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use UserFrosting\Sprinkle\SnDbForms\Model\Lookup;

/**
 * Groups table migration
 * "Group" now replaces the notion of "primary group" in earlier versions of UF.  A user can belong to exactly one group.
 * Version 4.0.0
 *
 * See https://laravel.com/docs/5.4/migrations#tables
 * @extends Migration
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class LookupTable extends UFMigration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        if (!$this->schema->hasTable('sevak_lookup')) {
    $this->schema->create('sevak_lookup', function(Blueprint $table) {
        
        $table->increments('id');
        $table->string('category', 100);
        $table->string('value', 255);
        $table->string('display_value', 255);
        $table->char('value_type', 1)->nullable();
        $table->integer('sort_order')->nullable();
        $table->char('status', 1)->default('A');
        $table->string('updated_by', 20)->nullable();
        $table->timestamp('updated_at'); 
        $table->string('created_by', 20)->nullable();
        $table->timestamp('created_at');        

        $table->engine = 'InnoDB';
        $table->collation = 'utf8_unicode_ci';
        $table->charset = 'utf8';
    });
} 
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->schema->drop('sevak_lookup');
    }
}