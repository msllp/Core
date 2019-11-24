<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 28-06-2019
 * Time: 03:31 AM
 */


return

    [

        'MS_Master'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_Master'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],


        'MS_UI'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_UI'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
        'MS_USER'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_USER'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],

        'DCM_User_Data' => [
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/DCM_User_Data'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
        'DCM_Master_Data' => [
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/DCM_Master_Data'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],


    ];
