<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 16-03-2019
 * Time: 02:09 AM
 */

namespace MS\Core\Helper;

use Illuminate\Support\Facades\Schema;

interface MasterNoSql
{

    // Table Function


    /**
     * To Create Table to Selected Database
     * @param $tableName
     * @param $columnArray
     * @param string $tableConnection
     * @return bool
     */
    public static function makeTable($tableName, $columnArray, $tableConnection="MSDB"):bool;
    public static function makeTableColumnWhenTableMaking(Schema $tableClass,$columnName,$columnType="string",$defaultValue=""):bool;
    public static function deleteTable():bool;


     // Table Column Function


    public static function addTableColumnToDB():bool;
    public static function updateTableColumnToDB():bool;
    public static function deleteTableColumnFromDB():bool;
    public static function getTableColumnFromDB():bool ;


    // Table Row Function


    public static function addRow():bool;
    public static function updateRow():bool;
    public static function deleteRow():bool;
    public static function getRow():bool;
}