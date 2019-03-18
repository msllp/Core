<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 16-03-2019
 * Time: 02:09 AM
 */

namespace MS\Core\Helper;

use \Illuminate\Support\Facades\Schema;

interface MasterNoSql
{


    public function __construct(string $nameSpace,string $id,array $perFix);

    // Table Function


    /**
     * To Create Table to Selected Database
     * @param $tableName
     * @param $columnArray
     * @param string $tableConnection
     * @return bool
     */
    public static function makeTable(string $tableName,array $columnArray,string $tableConnection="MSDB"):bool;
    public static function makeTableColumnWhenTableMaking( $tableClass,string $columnName,string $columnType="string",$defaultValue=""):bool;
    public function checkTableExist($id=false,$perFix=false):bool;
    /**
     * To delete Drop/Delete Table
     * @param string $tableName
     * @param string $tableConnection
     * @return bool
     */
    public static function deleteTable(string $tableName, string $tableConnection="MSDB"):bool;


    // Table Column Function
//    public static function addTableColumnToDB(string $tableName, string $tableConnection="MSDB",array $columnArray):bool;
//    public static function updateTableColumnToDB(string $tableName, string $tableConnection="MSDB",array $columnArray):bool;
//    public static function deleteTableColumnFromDB(string $tableName, string $tableConnection="MSDB",array $columnArray):bool;
//    public static function getTableColumnFromDB(string $tableName, string $tableConnection="MSDB",array $columnArray):bool ;


    // Table Row Function
//    public static function addRow(string $tableName,array $columnArray,string $tableConnection="MSDB"):bool;
//    public static function updateRow(string $tableName, array $identifier, array $columnArray, string $tableConnection="MSDB"):bool;
//    public static function deleteRow(string $tableNam,array $identifier,string $tableConnection="MSDB"):bool;
//    public static function getRow(string $tableName,array $identifier,string $tableConnection="MSDB"):bool;

    public function rowAdd(array $columnArray,array $uniqArray=[]):bool ;
    public function rowEdit(array $identifier,array $columnArray):bool ;
    public function rowDelete(array $identifier):bool ;
//    public function rowGet(array $identifier);
}
