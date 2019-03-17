<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 17-03-2019
 * Time: 02:07 AM
 */

namespace MS\Core\Template;


use MS\Core\Module\Master;

class Base extends Master
{

    public static $controller="MS\Core\Template\Controller";
    public static $model="MS\Core\Template\Model";

    public static $route=[

        [
            'name'=>'Template.Index',
            'route'=>'/',
            'method'=>'index',
            'type'=>'get',
        ],

        [
            'name'=>'Template.Index',
            'route'=>'/data',
            'method'=>'indexData',
            'type'=>'get',
        ],


    ];


    public static $allOnSameconnection=false;


    public static $tables=[

        //Master Table Start////
        "Master"=>[
            'tableName'=>'Master',
            'connection'=>'MSDB',
            'dynamic'=>true,
            'fields'=>
                [

    ['name'=>'TestColumnText','vName'=>'Test Column','type'=>'string', 'input'=>'text', 'callback'=>'genUniqId', 'default'=>'1'],
    ['name'=>'TestColumnNumber','vName'=>'Test Column','type'=>'int', 'input'=>'number', 'callback'=>'genUniqId', 'default'=>'1']

                ]
        ],

        //Master Table End////



    ];

}