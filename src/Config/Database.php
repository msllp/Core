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


        ///////For COMPANY


        'CM'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_COMPANY_Master'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
        'CC'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_COMPANY_Config'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
        'CD'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_COMPANY_Data'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],

///////For Accounts


        'AM'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_ACCOUNTS_Master'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
        'AC'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_ACCOUNTS_Config'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
        'AD'=>[
            'driver' => 'sqlite',
            'database' => base_path('MS/DB/Master/MS_ACCOUNTS_Data'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],




    ];
