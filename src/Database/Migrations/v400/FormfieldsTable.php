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
        
            $formfields = [
                        173 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "1", "db_field" => "id", "visible" => "Y", "orderable" => "N", "searchable" => "N", "edit_group" => "1.10", "showin_editform" => "N", "label" => "Id", "type" => "text", "size1" => "", "size2" => "", "lookup_category" => "", "value_type" => "", "primary_key" => "Y", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        174 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "2", "db_field" => "form_prefix", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "1.20", "showin_editform" => "Y", "label" => "Form prefix", "type" => "text", "size1" => "10", "size2" => "10", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        175 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "3", "db_field" => "source", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "2.30", "showin_editform" => "Y", "label" => "Source", "type" => "text", "size1" => "100", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        176 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "4", "db_field" => "seq", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "2.40", "showin_editform" => "Y", "label" => "Seq", "type" => "text", "size1" => "", "size2" => "", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        177 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "5", "db_field" => "db_field", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "2.50", "showin_editform" => "Y", "label" => "Db field", "type" => "text", "size1" => "200", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        178 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "6", "db_field" => "visible", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "3.60", "showin_editform" => "Y", "label" => "Visible", "type" => "text", "size1" => "1", "size2" => "1", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        179 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "7", "db_field" => "orderable", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "3.70", "showin_editform" => "Y", "label" => "Orderable", "type" => "text", "size1" => "1", "size2" => "1", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        180 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "8", "db_field" => "searchable", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "3.80", "showin_editform" => "Y", "label" => "Searchable", "type" => "text", "size1" => "1", "size2" => "1", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        181 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "9", "db_field" => "edit_group", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "4.90", "showin_editform" => "Y", "label" => "Edit group", "type" => "text", "size1" => "", "size2" => "", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        182 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "10", "db_field" => "showin_editform", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "5.00", "showin_editform" => "Y", "label" => "Showin editform", "type" => "text", "size1" => "1", "size2" => "1", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        183 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "11", "db_field" => "label", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "5.10", "showin_editform" => "Y", "label" => "Label", "type" => "text", "size1" => "200", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        184 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "12", "db_field" => "type", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "6.20", "showin_editform" => "Y", "label" => "Type", "type" => "text", "size1" => "200", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        185 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "13", "db_field" => "size1", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "6.30", "showin_editform" => "Y", "label" => "Size1", "type" => "text", "size1" => "", "size2" => "", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        186 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "14", "db_field" => "size2", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "6.40", "showin_editform" => "Y", "label" => "Size2", "type" => "text", "size1" => "", "size2" => "", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        187 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "15", "db_field" => "lookup_category", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "7.50", "showin_editform" => "Y", "label" => "Lookup category", "type" => "text", "size1" => "200", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        188 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "16", "db_field" => "value_type", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "7.60", "showin_editform" => "Y", "label" => "Value type", "type" => "text", "size1" => "1", "size2" => "1", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        189 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "17", "db_field" => "primary_key", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "7.70", "showin_editform" => "Y", "label" => "Primary key", "type" => "text", "size1" => "1", "size2" => "1", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        190 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "18", "db_field" => "message", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "8.80", "showin_editform" => "Y", "label" => "Message", "type" => "text", "size1" => "255", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        191 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "19", "db_field" => "validation_json", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "8.90", "showin_editform" => "Y", "label" => "Validation json", "type" => "text", "size1" => "1000", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        192 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "20", "db_field" => "default", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "9.00", "showin_editform" => "Y", "label" => "Default", "type" => "text", "size1" => "255", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        193 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "21", "db_field" => "search_function", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "10.10", "showin_editform" => "Y", "label" => "Search function", "type" => "text", "size1" => "50", "size2" => "25", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        194 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "22", "db_field" => "status", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "10.20", "showin_editform" => "Y", "label" => "Status", "type" => "select", "size1" => "1", "size2" => "1", "lookup_category" => "rec_status", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        195 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "23", "db_field" => "updated_by", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "10.30", "showin_editform" => "N", "label" => "Updated by", "type" => "text", "size1" => "20", "size2" => "20", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        196 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "24", "db_field" => "created_by", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "11.40", "showin_editform" => "N", "label" => "Created by", "type" => "text", "size1" => "20", "size2" => "20", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "LIKE", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        197 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "25", "db_field" => "created_at", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "11.50", "showin_editform" => "N", "label" => "Created at", "type" => "text", "size1" => "", "size2" => "", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"]),
                        198 => new Formfields(["form_prefix" => "sffld_", "source" => "sevak_formfields", "seq" => "26", "db_field" => "updated_at", "visible" => "N", "orderable" => "N", "searchable" => "N", "edit_group" => "11.60", "showin_editform" => "N", "label" => "Updated at", "type" => "text", "size1" => "", "size2" => "", "lookup_category" => "", "value_type" => "", "primary_key" => "", "message" => "", "validation_json" => "", "default" => "", "search_function" => "=", "status" => "A", "updated_by" => "snukala", "created_by" => "snukala"])

            ];
            foreach ($formfields as $id => $ffield) {
                $ffield->save();
            }
        
    }

    /**
     * {@inheritDoc}
     */
    public function down() {
        $this->schema->drop('sevak_formfields');
    }

}
