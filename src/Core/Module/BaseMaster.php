<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 16-03-2019
 * Time: 04:19 AM
 */

namespace MS\Core\Module;


interface BaseMaster
{

    public static function getTable($tableID,$perFix=false):string ;

    public static function getConnection($tableID):string ;

    public static function getField($tableID):string ;


}