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
use UserFrosting\Sprinkle\AutoForms\Database\Models\Lookup;

/**
 * Groups table migration
 * "Group" now replaces the notion of "primary group" in earlier versions of UF.  A user can belong to exactly one group.
 * Version 4.0.0
 *
 * See https://laravel.com/docs/5.4/migrations#tables
 * @extends Migration
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class LookupTable extends Migration {

    /**
     * {@inheritDoc}
     */
    public function up() {
        if (!$this->schema->hasTable('sevak_lookup')) {
            $this->schema->create('sevak_lookup', function(Blueprint $table) {

                $table->increments('id');
                $table->string('category', 100);
                $table->string('value', 255);
                $table->string('display_value', 255);
                $table->char('value_type', 1)->nullable();
                $table->integer('sort_order')->nullable();
                $table->char('status', 1)->default('A');
                $table->string('created_by', 20)->nullable();
                $table->string('updated_by', 20)->nullable();
                $table->timestamps();

                $table->engine = 'InnoDB';
                $table->collation = 'utf8_unicode_ci';
                $table->charset = 'utf8';
            });
        } else {
            $lookup_fields = [
                "5" => new Lookup(["category" => "frm_search_function", "value" => "between", "display_value" => "Range", "sort_order" => "", "status" => "A"]),
                "6" => new Lookup(["category" => "frm_search_function", "value" => "like", "display_value" => "Like", "sort_order" => "", "status" => "A"]),
                "4" => new Lookup(["category" => "frm_search_function", "value" => "=", "display_value" => "Equal", "sort_order" => "0", "status" => "A"]),
                "1" => new Lookup(["category" => "frm_searchable", "value" => "N", "display_value" => "No", "sort_order" => "0", "status" => "A"]),
                "2" => new Lookup(["category" => "frm_searchable", "value" => "R", "display_value" => "Range", "sort_order" => "0", "status" => "A"]),
                "3" => new Lookup(["category" => "frm_searchable", "value" => "Y", "display_value" => "Yes", "sort_order" => "0", "status" => "A"]),
                "7" => new Lookup(["category" => "frm_type", "value" => "checkbox", "display_value" => "Checkbox", "sort_order" => "", "status" => "A"]),
                "8" => new Lookup(["category" => "frm_type", "value" => "date", "display_value" => "Date", "sort_order" => "", "status" => "A"]),
                "9" => new Lookup(["category" => "frm_type", "value" => "password", "display_value" => "Password", "sort_order" => "", "status" => "A"]),
                "10" => new Lookup(["category" => "frm_type", "value" => "radio", "display_value" => "RadioButton", "sort_order" => "", "status" => "A"]),
                "11" => new Lookup(["category" => "frm_type", "value" => "select", "display_value" => "Select", "sort_order" => "", "status" => "A"]),
                "12" => new Lookup(["category" => "frm_type", "value" => "statictext", "display_value" => "StaticText", "sort_order" => "", "status" => "A"]),
                "13" => new Lookup(["category" => "frm_type", "value" => "text", "display_value" => "Text", "sort_order" => "", "status" => "A"]),
                "14" => new Lookup(["category" => "frm_type", "value" => "textarea", "display_value" => "TextArea", "sort_order" => "", "status" => "A"]),
                "127" => new Lookup(["category" => "month", "value" => "1", "display_value" => "Jan", "sort_order" => "1", "status" => "A"]),
                "128" => new Lookup(["category" => "month", "value" => "2", "display_value" => "Feb", "sort_order" => "2", "status" => "A"]),
                "129" => new Lookup(["category" => "month", "value" => "3", "display_value" => "Mar", "sort_order" => "3", "status" => "A"]),
                "130" => new Lookup(["category" => "month", "value" => "4", "display_value" => "Apr", "sort_order" => "4", "status" => "A"]),
                "131" => new Lookup(["category" => "month", "value" => "5", "display_value" => "May", "sort_order" => "5", "status" => "A"]),
                "132" => new Lookup(["category" => "month", "value" => "6", "display_value" => "Jun", "sort_order" => "6", "status" => "A"]),
                "133" => new Lookup(["category" => "month", "value" => "7", "display_value" => "Jul", "sort_order" => "7", "status" => "A"]),
                "134" => new Lookup(["category" => "month", "value" => "8", "display_value" => "Aug", "sort_order" => "8", "status" => "A"]),
                "135" => new Lookup(["category" => "month", "value" => "9", "display_value" => "Sep", "sort_order" => "9", "status" => "A"]),
                "136" => new Lookup(["category" => "month", "value" => "10", "display_value" => "Oct", "sort_order" => "10", "status" => "A"]),
                "137" => new Lookup(["category" => "month", "value" => "11", "display_value" => "Nov", "sort_order" => "11", "status" => "A"]),
                "138" => new Lookup(["category" => "month", "value" => "12", "display_value" => "Dec", "sort_order" => "12", "status" => "A"]),
                "21" => new Lookup(["category" => "user_status", "value" => "A", "display_value" => "Active", "sort_order" => "1", "status" => "A"]),
                "23" => new Lookup(["category" => "user_status", "value" => "I", "display_value" => "Inactive", "sort_order" => "2", "status" => "A"]),
                "22" => new Lookup(["category" => "user_status", "value" => "D", "display_value" => "Duplicate", "sort_order" => "3", "status" => "A"]),
                "18" => new Lookup(["category" => "yes_no", "value" => "Y", "display_value" => "Yes", "sort_order" => "1", "status" => "A"]),
                "17" => new Lookup(["category" => "yes_no", "value" => "N", "display_value" => "No", "sort_order" => "2", "status" => "A"])];

            foreach ($lookup_fields as $id => $lookup_field) {
                $lookup_field->save();
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function down() {
        $this->schema->drop('sevak_lookup');
    }

}
