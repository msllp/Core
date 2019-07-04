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

    public static $ds=DIRECTORY_SEPARATOR;

    public static function getBasics(){
        $return=[
            'dbList'=>[],
            'basePath'=>null
        ];
        $ex=explode('\\',static::$controller);
        $end=explode('\\',static::$controller)[0];
        $module=explode('\\',static::$controller)[1];
        $modulePath=[base_path(),'MS',$end,'M',$module,'T'];
        $moduleDBPath=implode(self::$ds,$modulePath);
        $return['basePath']=implode(self::$ds,$modulePath);
        if(!is_dir($moduleDBPath))return $return;

        $return['dbList']=array_diff( scandir($moduleDBPath),['.','..']);
        return $return;
    }

    public static function getModuleTables(){

        $base=self::getBasics();

        $returnArray=[];
        $allExistDB=$base['dbList'];
        $moduleDBPath=$base['basePath'];

        foreach ($allExistDB as $fileName){

            $dbData= include (implode(self::$ds,[$moduleDBPath,$fileName]));

            foreach ($dbData as $tableID=>$tableDetails){
                if(!array_key_exists($tableID,$returnArray))$returnArray[$tableID]=$tableDetails;
            }

        }
        $return=array_merge(  static::$tables,$returnArray);

      return $return;
    }

    public static function getTable($tableID=false,$perFix=false):string
    {

        $table= self:: getModuleTables() ;
        if(!$tableID)$tableID=array_key_first($table);

        if(array_key_exists($tableID,$table)){

            if(substr($table[$tableID]['tableName'], -1)=="_"){

                if(is_array($perFix)){
                    return $table[$tableID]['tableName'].implode("_",$perFix);
                }else{
                    return $table[$tableID]['tableName'].$perFix;
                }

            }

            return $table[$tableID]['tableName'];
        }
        if(count($table) > 0){
            return reset($table)['tableName'];
        }
        return"No Module Table Found";

    }
    public static function getTableArray($tableID=false):array
    {

        $table= self:: getModuleTables() ;
        if(!$tableID)$tableID=array_key_first($table);

        if(array_key_exists($tableID,$table)){


            return $table[$tableID];
        }
        if(count($table) > 0){
            return reset($table);
        }
        return"No Module Table Found";

    }


    public static function getConnection($tableID=false):string
    {
        $table= self:: getModuleTables() ;
        if(!$tableID)$tableID=array_key_first($table);
        if(array_key_exists($tableID,$table)){
            return $table[$tableID]['connection'];
        }
        if(count($table) > 0){
            return reset($table)['connection'];
        }
        return"No Connection Found";
    }

    public static function getField($tableID=false):array
    {
        $table= self:: getModuleTables() ;
        if(!$tableID)$tableID=array_key_first($table);
        if(array_key_exists($tableID,$table)){
            return $table[$tableID]['fields'];
        }
        if(count($table) > 0){
            return reset($table)['fields'];
        }
        return ["No Connection Found"];
    }



    public static function getAction($tableID=false){
        $table= self:: getModuleTables() ;

        if(!$tableID)$tableID=array_key_first($table);
      //  dd($tableID);
        if(array_key_exists($tableID,$table)){
          //  dd($table[$tableID]['action']);
            return $table[$tableID]['action'];
        }
        if(count($table) < 1){
            return reset($table)['action'];
        }
        return"No Connection Found";
    }
}
