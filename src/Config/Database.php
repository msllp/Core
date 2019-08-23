<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 28-06-2019
 * Time: 03:31 AM
 */


return

    [


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
