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
        $table->timestamps();

        $table->engine = 'InnoDB';
        $table->collation = 'utf8_unicode_ci';
        $table->charset = 'utf8';
    });

    // Add default groups
//    $groups = [
//        'terran' => new Group([
//            'slug' => 'terran',
//            'name' => 'Terran',
//            'description' => 'The terrans are a young species with psionic potential. The terrans of the Koprulu sector descend from the survivors of a disastrous 23rd century colonization mission from Earth.',
//            'icon' => 'sc sc-terran'
//                ]),
//        'zerg' => new Group([
//            'slug' => 'zerg',
//            'name' => 'Zerg',
//            'description' => 'Dedicated to the pursuit of genetic perfection, the zerg relentlessly hunt down and assimilate advanced species across the galaxy, incorporating useful genetic code into their own.',
//            'icon' => 'sc sc-zerg'
//                ]),
//        'protoss' => new Group([
//            'slug' => 'protoss',
//            'name' => 'Protoss',
//            'description' => 'The protoss, a.k.a. the Firstborn, are a sapient humanoid race native to Aiur. Their advanced technology complements and enhances their psionic mastery.',
//            'icon' => 'sc sc-protoss'
//                ])
//    ];
//
//        foreach ($groups as $slug => $group) {
//            $group->save();
//        }
    echo "Created table 'formfields'..." . PHP_EOL;
} else {
    echo "Table 'formfields' already exists.  Skipping..." . PHP_EOL;
}