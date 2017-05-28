<?php

/**
 * UserFrosting (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/UserFrosting
 * @copyright Copyright (c) 2013-2016 Alexander Weissman
 * @license   https://github.com/userfrosting/UserFrosting/blob/master/licenses/UserFrosting.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Model\Migrations\v400;

use UserFrosting\System\Bakery\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use UserFrosting\Sprinkle\SnDbForms\Model\Formfields;

/**
 * Formfields table migration
 * Version 4.0.0
 *
 * See https://laravel.com/docs/5.4/migrations#tables
 * @extends Migration
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class FormfieldsTable extends Migration {

    /**
     * {@inheritDoc}
     */
    public function up() {
        if (!$this->schema->hasTable('sevak_formfields')) {
            $this->schema->create('sevak_formfields', function(Blueprint $table) {

                $table->increments('id');
                $table->string('form_prefix', 10);
                $table->string('table_name', 100);
                $table->integer('seq')->default('0');
                $table->string('db_name', 200);
                $table->char('value_type', 1)->nullable();
                $table->decimal('edit_group', 5, 2)->default('0.00');
                $table->char('hidden', 1)->default('N');
                $table->char('orderable', 1)->default('N');
                $table->string('type', 200);
                $table->string('lookup_cat', 200)->nullable();
                $table->char('showin_editform', 1)->default('Y');
                $table->char('primary_key', 1)->default('N');
                $table->string('label', 200)->nullable();
                $table->string('message', 255)->nullable();
                $table->string('validation_json', 1000)->nullable();
                $table->integer('size1')->nullable();
                $table->integer('size2')->nullable();
                $table->string('default', 255)->nullable();
                $table->char('empty_check', 1)->default('N');
                $table->char('searchable', 1)->default('N');
                $table->decimal('search_group', 5, 2)->default('0.00');
                $table->char('showin_searchresult', 1)->default('N');
                $table->decimal('result_group', 5, 2)->nullable();
                $table->char('search_function', 50)->nullable();
                $table->char('showin_shortform', 1)->default('N');
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
    public function down() {
        $this->schema->drop('sevak_formfields');
    }

}
