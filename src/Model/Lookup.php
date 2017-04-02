<?php
namespace UserFrosting\Sprinkle\SnDbForms\Model;
use \Illuminate\Database\Capsule\Manager as Capsule; 
use UserFrosting\Sprinkle\Core\Model\UFModel;

class Lookup extends UFModel {
    protected $table = "cmadm_lookup";

    protected $fillable = ['category','value','sort_order','status'];
        
    
    /* Fetch a list of iListUsers based on the value of a given column.  Returns empty array if no match is found.
     * @param value $value The value to find. (defaults to null, which means return all records in the table)
     * @param string $name The name of the column to match (defaults to null)
     * @return array An array of iListUser objects
     */

    public static function getLookupValues($category,$catcondition='=',$status='A', $par_orderdir = 'ASC') {
        if(strtolower($catcondition)=='in')
            $resultArr = self::whereIn('category', $category)->where('status','=',$status)->orderBy('sort_order',$par_orderdir)->get();
        else
            $resultArr = self::where('category',$catcondition, $category)->where('status','=',$status)->orderBy('sort_order',$par_orderdir)->get();
        $var_result_rec = $var_result = array();
        foreach ($resultArr as $var_rowid => $var_resrow) {
            $var_result_rec['value']=$var_resrow->value;
            $var_result_rec['text']=$var_resrow->display_value;
            $var_result[$var_resrow->category][]=$var_result_rec;
        }
//echoarr($var_classfields[$par_table],"Line 618 classfields array");
        return $var_result;
    }
    public static function getLookupValuesList($category,$catcondition='=',$status='A', $par_orderdir = 'ASC') {
        if(strtolower($catcondition)=='in')
            $resultArr = self::whereIn('category', $category)->where('status','=',$status)->orderBy('sort_order',$par_orderdir)->get();
        else
            $resultArr = self::where('category',$catcondition, $category)->where('status','=',$status)->orderBy('sort_order',$par_orderdir)->get();
        $var_result_rec = $var_result = array();
        foreach ($resultArr as $var_rowid => $var_resrow) {
            $var_result_rec['value']=$var_resrow->value;
            $var_result_rec['text']=$var_resrow->display_value;
            $var_val = $var_resrow->value==''?'-NA-':$var_resrow->value;
            $var_result[$var_resrow->category][$var_val]=$var_resrow->display_value;
        }
//echoarr($var_classfields[$par_table],"Line 618 classfields array");
        return $var_result;
    }
    
    public static function getLookupValuesList2($category,$catcondition='=',$status='A', $par_orderdir = 'ASC') {
        if(strtolower($catcondition)=='in')
            $resultArr = self::whereIn('category', $category)->where('status','=',$status)->orderBy('sort_order',$par_orderdir)->get();
        else
            $resultArr = self::where('category',$catcondition, $category)->where('status','=',$status)->orderBy('sort_order',$par_orderdir)->get();
        $var_result_rec = $var_result = array();
        foreach ($resultArr as $var_rowid => $var_resrow) {
            $var_result_rec['value']=$var_resrow->value;
            $var_result_rec['text']=$var_resrow->display_value;
            $var_val = $var_resrow->value==''?'-NA-':$var_resrow->value;
            $var_result[$var_resrow->category]['list'][$var_val]=$var_resrow->display_value;
            $var_result[$var_resrow->category]['array'][]=$var_result_rec;
        }
//echoarr($var_classfields[$par_table],"Line 618 classfields array");
        return $var_result;
    }
    
}