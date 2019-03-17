<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 16-03-2019
 * Time: 04:18 AM
 */

namespace MS\Core\Module;


class Master implements BaseMaster
{


    public static function getTable($tableID=false,$perFix=false):string
    {
        if(!$tableID)$tableID=array_key_first(static ::$tables);

        if(array_key_exists($tableID,static::$tables)){

            if(substr(static ::$tables[$tableID]['tableName'], -1)=="_"){

                if(is_array($perFix)){
                    return static ::$tables[$tableID]['tableName'].implode("_",$perFix);
                }else{
                    return static ::$tables[$tableID]['tableName'].$perFix;
                }

            }

            return static ::$tables[$tableID]['tableName'];
        }
        if(count(static ::$tables) > 0){
            return reset(static ::$tables)['tableName'];
        }
        return"No Module Table Found";

    }

    public static function getConnection($tableID=false):string
    {
        if(!$tableID)$tableID=array_key_first(static ::$tables);
        if(array_key_exists($tableID,static ::$tables)){
            return static ::$tables[$tableID]['connection'];
        }
        if(count(static ::$tables) > 0){
            return reset(static ::$tables)['connection'];
        }
        return"No Connection Found";
    }

    public static function getField($tableID=false):array
    {
        if(!$tableID)$tableID=array_key_first(static ::$tables);
        if(array_key_exists($tableID,static ::$tables)){
            return static ::$tables[$tableID]['fields'];
        }
        if(count(static ::$tables) > 0){
            return reset(static ::$tables)['fields'];
        }
        return ["No Connection Found"];
    }
    }


}