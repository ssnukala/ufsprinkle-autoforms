<?php

/**
 * SN DB Forms (http://www.srinivasnukala.com)
 *
 * @link      https://github.com/ssnukala/ufsprinkle-autoforms/
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 */

namespace UserFrosting\Sprinkle\AutoForms\Database\Migrations\v400;

use UserFrosting\System\Bakery\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use UserFrosting\Sprinkle\AutoForms\Database\Models\Formfields;

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
                $table->string('source', 100);
                $table->integer('seq')->default('0');
                $table->string('db_field', 200);
                $table->char('visible', 1)->default('Y');
                $table->char('orderable', 1)->default('N');
                $table->char('searchable', 1)->default('N');
                $table->decimal('edit_group', 5, 2)->default('0.00');
                $table->char('showin_editform', 1)->default('Y');
                $table->string('label', 200)->nullable();
                $table->string('type', 200);
                $table->integer('size1')->nullable();
                $table->integer('size2')->nullable();
                $table->string('lookup_category', 200)->nullable();
                $table->char('value_type', 1)->nullable();
                $table->char('primary_key', 1)->default('N');
                $table->string('message', 255)->nullable();
                $table->string('validation_json', 1000)->nullable();
                $table->string('default', 255)->nullable();
                $table->char('search_function', 50)->nullable();
                $table->char('status', 1)->default('A');
                $table->string('updated_by', 20)->nullable();
                $table->string('created_by', 20)->nullable();
                $table->timestamps();
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
