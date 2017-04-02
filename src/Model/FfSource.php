<?php
namespace UserFrosting\Sprinkle\SnDbForms\Model;
use \Illuminate\Database\Capsule\Manager as Capsule; 
use UserFrosting\Sprinkle\Core\Model\UFModel;

class FfSource extends UFModel {
protected static $_table_id = "undefined";

    public function __construct($properties=[], $id = null) {
        parent::__construct($properties, $id);
    }
    static function init($table) {
        static::$_table_id = $table;
    }
    public function store($force_create = false){
        // Initialize creation time for new iListUser records
        if (!isset($this->_id) || $force_create){
            $this->created_date = date("Y-m-d H:i:s");
        }        
        // Update the record
        return parent::store();
    }

    public static function exists($value, $name = "id"){
        if ($name == "id")
            // Fetch by id
            return ( self::find($value) ? true : false );
        else
            // Fetch by some other column name
            return ( self::where($name, $value)->first() ? true : false );
    }
    
    /**
     * Fetch a single record based on the value of a given column.
     *
     * For non-unique columns, it will return the first entry found.  Returns false if no match is found.
     * @param value $value The value to find.
     * @param string $name The name of the column to match (defaults to id)
     * @return cdDatatableSource
     */
    public static function fetch($value, $name = "id"){

        if ($name == "id")
            // Fetch by id
            $results_obj =  self::find($value);
        else
            // Fetch by some other column name
            $results_obj = self::where($name, $value)->first();
        if ($results)
        {
            $results=$results_obj->toArray();
        }
        else
            return false;
        
    }
    
    public static function fetchAll($value = null, $name = null){
        if (!$value || !$name)
            $results_obj = self::all();
        else
            $results_obj = self::where($name, $value)->get();
            
//!$result->isEmpty()        
        if ($results)
        {
            $results=$results_obj->toArray();
        }
        else
            return false;
    }

    
}
