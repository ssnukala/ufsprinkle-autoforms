<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
//use UserFrosting\Sprinkle\Account\Model\Group;

/**
 * "Group" now replaces the notion of "primary group" in earlier versions of UF.  A user can belong to exactly one group.
 */
    echo "Creating table 'formfields'..." . PHP_EOL;
if (!$schema->hasTable('adm_formfields')) {
    $schema->create('adm_formfields', function(Blueprint $table) {

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
        $table->string('created_by', 20)->nullable();
        $table->string('updated_by', 20)->nullable();
//        $table->timestamps();
        $table->timestamp('updated_at'); 
        $table->timestamp('created_at');        

        $table->engine = 'InnoDB';
        $table->collation = 'utf8_unicode_ci';
        $table->charset = 'utf8';
    });
    echo "Created table 'formfields'..." . PHP_EOL;
} else {
    echo "Table 'formfields' already exists.  Skipping..." . PHP_EOL;
}
    echo "Creating table 'Lookup'..." . PHP_EOL;
if (!$schema->hasTable('adm_lookup')) {
    $schema->create('adm_lookup', function(Blueprint $table) {
        
        $table->increments('id');
        $table->string('category', 100);
        $table->string('value', 255);
        $table->string('display_value', 255);
        $table->char('value_type', 1)->nullable();
        $table->integer('sort_order')->nullable();
        $table->char('status', 1)->default('A');
        $table->string('updated_by', 20)->nullable();
//        $table->timestamps();
        $table->timestamp('updated_at'); 
        $table->string('created_by', 20)->nullable();
        $table->timestamp('created_at');        

        $table->engine = 'InnoDB';
        $table->collation = 'utf8_unicode_ci';
        $table->charset = 'utf8';
    });
    echo "Created table 'adm_lookup'..." . PHP_EOL;
} else {
    echo "Table 'adm_lookup' already exists.  Skipping..." . PHP_EOL;
}