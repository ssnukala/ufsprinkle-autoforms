<?php
/**
 * UserFrosting (http://www.srinivasnukala.com)
 *
 * @link      https://github.com/ssnukala/ufsprinkle-sndbforms
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala

 **/

namespace UserFrosting\Sprinkle\SnDbforms\Model;
use \Illuminate\Database\Capsule\Manager as Capsule; 
use UserFrosting\Sprinkle\Core\Model\UFModel;

class Lookup extends UFModel {
    protected $table = "sevak_lookup";

    protected $fillable = ['category','value','diaplay_value','sort_order','status'];
        
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