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
                    'prefix'=>implode('_',$perFix),
            ];
        $this->model=new $this->database['namespace'] ($id,$this->database['prefix']);
        //parent::__construct($nameSpace, $id, $perFix);

    }

    public function rowAdd(array $columnArray)
    {

        DB::table('users')->insert(
            ['email' => 'john@example.com', 'votes' => 0]
        );
        // TODO: Implement rowAdd() method.
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
                });
            }else{
                Schema::dropIfExists($tableName);
                Schema::create($tableName, function (Blueprint $table) use ($columnArray) {
                    $table->increments('id');
                    foreach ($columnArray as $value) {
                        self::makeTableColumnWhenTableMaking($table,$value['name'],$value['type']);
                    }
                    $table->timestamps();
                });
            }
        return true;
        }catch(Exception $e) {
        return false;
        }
    }

    public static function makeTableColumnWhenTableMaking(Schema $tableClass,string $columnName,string $columnType = "string", $defaultValue = ""): bool
    {
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
    }

    public static function deleteTable(string $tableName, string $tableConnection = "MSDB"): bool
    {
        // TODO: Implement deleteTable() method.

    }

}