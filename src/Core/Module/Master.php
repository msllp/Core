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


    public static function getTable($tableID,$perFix=false):string
    {
        if(array_key_exists($tableID,static ::$tables)){

            if(substr(static ::$tables[$tableID]['tableName'], -1)){}




            return static ::$tables[$tableID]['tableName'];
        }
        if(count(static ::$tables) > 0){
            return reset(static ::$tables);
        }
        return"No Module Table Found";

    }

    public static function getConnection($tableID):string
    {
        if(array_key_exists($tableID,static ::$tables)){
            return static ::$tables[$tableID]['connection'];
        }
        if(count(static ::$tables) > 0){
            return reset(static ::$tables);
        }
        return"No Connection Found";
    }

    public static function getField($tableID):string
    {
        if(array_key_exists($tableID,static ::$tables)){
            return static ::$tables[$tableID]['fields'];
        }
        if(count(static ::$tables) > 0){
            return reset(static ::$tables);
        }
        return"No Connection Found";
    }


}