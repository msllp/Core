<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 16-03-2019
 * Time: 02:09 AM
 */

namespace MS\Core\Helper;

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;

class MSDB implements MasterNoSql
{


    public $model,$database,$table;

    public function __construct(string $nameSpace, string $id, array $perFix)
    {
        $this->database=[
            'namespace'=>"\\".$nameSpace."\\Model",
            'id'=>$id,
            'perfix'=>implode('_',$perFix),
        ];
        $this->model=new $this->database['namespace'] ( $nameSpace,$id,$this->database['perfix']);
        //parent::__construct($nameSpace, $id, $perFix);

    }


    public function checkTableExist($id=false,$perFix=false):bool{

        $connection=$this->model->getConnectionName();
        $table=$this->model->getTable();

        return Schema::connection($connection)->hasTable($table);
    }
    public function migrate($id=false,$perFix=false):bool {

        if (is_array($id) && is_array($perFix)){


        }else{

            $table=$this->model->getTable();
            $connection=$this->model->getConnectionName();
            $fields=$this->model->base_Field;


        }

        // dd($this);

        // dd($this);
        if(!$this->checkTableExist($id,$perFix)){
            return self::makeTable($table,$fields,$connection);
        }

        return false;
    }
    public function delete():bool {

        $table=$this->model->getTable();
        $connection=$this->model->getConnectionName();
        return self::deleteTable($table,$connection);


    }

    public function rowAdd(array $columnArray,array $uniqArray=[]):bool
    {
        if(!array_key_exists('created_at',$columnArray))$columnArray['created_at']=now()->toDateTimeString();
        if(!array_key_exists('updated_at',$columnArray))$columnArray['updated_at']=now()->toDateTimeString();
        try{

            $connection=$this->model->getConnectionName();
            $table=$this->model->getTable();
            $tableName=$table;
            // $connection=$this->database['namespace']::getConnection($this->database['id']).$this->database['perfix'];
            \DB::connection($connection)->table($tableName)->insert($columnArray);


        }catch (\Exception $e){

            return false;


        }

        return true;

        // TODO: Implement rowAdd() method.
    }
    public function rowEdit(array $identifier, array $columnArray):bool
    {
        // TODO: Implement rowEdit() method.
        $connection=$this->model->getConnectionName();
        $table=$this->model->getTable();
        $fields=$this->model->base_Field;
        if(!array_key_exists('updated_at',$columnArray))$columnArray['updated_at']=now()->toDateTimeString();
        if(count($identifier) < 2){
            dd(reset($identifier));
            //$objFields=collect($fields)->where(array_key_first($identifier),reset($identifier) );
        }else{

            $objFields=collect($fields)->where('name',array_key_first($identifier))->count();
            if ($objFields > 0){

                \DB::connection($connection)->table($table)->update( $columnArray);
                return true;
            }

        }

        return false;
    }

    public function rowDelete(array $identifier):bool
    {
        // TODO: Implement rowDelete() method.
        $connection=$this->model->getConnectionName();
        $table=$this->model->getTable();
        $fields=$this->model->base_Field;

        if(count($identifier) < 2){
            dd(reset($identifier));
            //$objFields=collect($fields)->where(array_key_first($identifier),reset($identifier) );
        }else{

            $objFields=collect($fields)->where('name',array_key_first($identifier))->count();
            if ($objFields > 0){
            \DB::connection($connection)->table($table)->where(array_key_first($identifier),reset($identifier))->delete();
                return true;
            }

        }

        return false;

    }

    public static function makeTable(string $tableName,array $columnArray,string $tableConnection = "MSDB"): bool
    {


        try{

            if($tableConnection!="MSDB"){
                Schema::connection($tableConnection)->dropIfExists($tableName);
                Schema::connection($tableConnection)->create($tableName, function (Blueprint $table)use ($columnArray)  {
                    $table->increments('id');
                    foreach ($columnArray as $value) {

                        self::makeTableColumnWhenTableMaking($table,$value['name'],$value['type']);
                    }

                    $table->timestamps();
                    // dd($table);
                });
            }else{
                Schema::dropIfExists($tableName);
                Schema::create($tableName, function (Blueprint $table) use ($columnArray) {
                    $table->increments('id');
                    foreach ($columnArray as $value) {
                        //  dd($table);
                        self::makeTableColumnWhenTableMaking($table,$value['name'],$value['type']);
                    }
                    $table->timestamps();
                });
            }

        }catch(Exception $e) {
            return false;
        }

        return true;
    }

    public static function makeTableColumnWhenTableMaking( $tableClass,string $columnName,string $columnType = "string", $defaultValue = ""): bool
    {
        // dd($tableClass);
        switch ($columnType) {
            case 'boolean':
                $tableClass->boolean($columnName)->default(false);
                break;
            case 'integer':
                $tableClass->integer($columnName)->default(0);
                break;

            case 'blob':
                $tableClass->binary($columnName);
                break;


            default:
                if(($defaultValue !=" ") or ($defaultValue !="")){
                    $tableClass->string($columnName)->default($defaultValue);
                }else{
                    $tableClass->string($columnName)->nullable();
                }
                break;
        }
        return true;
    }

    public static function deleteTable(string $tableName, string $tableConnection = "MSDB"): bool
    {
        //dd( Schema::connection($tableConnection)->drop($tableName));
        try{
            Schema::connection($tableConnection)->drop($tableName);
        }catch (Exception $e){return false;}
        return true;
    }

}
