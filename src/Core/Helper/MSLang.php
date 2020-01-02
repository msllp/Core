<?php


namespace MS\Core\Helper;


class MSLang
{


    public static function  getCore($lang='en'){
        $finalData=[];
        switch ($lang){
            case 'en':
                $finalData=self::getCoreEn();
                break;
        }


        return $finalData;
    }

    public static function getCoreEn(){
        $finalData=[
            'tableId' => 'Table ID',
            'tableName' => 'Table Name',
            'Status' => 'Status',
            'UniqId'=>'ID',

            'fieldName'=>'Name of Fields',
            'fieldDisplayName'=>'Display Name of Fields',
            'fieldStoreToDB'=>'Store to DB',
            'fieldType'=>'DB Type',
            'fieldInput'=>'Input Type',
            'fieldValidation'=>'Validation Details',

            'actionRoute'=>'',
            'actionBtnText'=>'',
            'actionBtnIcon'=>'',
            'actionBtnColor'=>'',
            'actionRoutePara'=>'',
            'actionMsLinkKey'=>'',
            'actionMsLinkText'=>'',
            'actionDoubleConFirm'=>'',
            'actionDoubleConFirmText'=>'',
            'actionOwnTab'=>'',



        ];


        return $finalData;
    }

}
