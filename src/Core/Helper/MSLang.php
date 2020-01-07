<?php


namespace MS\Core\Helper;


class MSLang
{

    public static $allowedMod=['Sales','Purchase','Company','Accounts'];

    public static $allowedLan=['en','gj','hin'];
    public static function  getCore($lang='en'){
        $finalData=[];
       if(in_array($lang,self::$allowedLan)) switch ($lang){
            case 'en':
                $finalData=self::getCoreEn();
                break;
        }


        return $finalData;
    }
    public static function getMod($modId){
        $finalData=[];
        $methodName=implode('',['get',$modId]);
        if(in_array($modId,self::$allowedMod) ) $finalData=self::$methodName();


      //  dd($finalData);
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


            'productCategory'=>'Product Category Details',
            'productCategoryAddBtn'=>'Add Product',
            'productCategoryAddFormTitle'=>'Add new Product',

       //     'VendorCategory'=>'Product Category Details',
            'vendorGroup1'=>'Basic Details',
            'vendorGroup2'=>'Legal Details',
            'vendorGroup3'=>'Address Details',
            'vendorGroup4'=>'Contact Details',
            'vendorGroup5'=>'Module Connect',







        ];


        return $finalData;
    }

    public static function getSales($lang='en'){
        $finalData=[
            'Navtitle1'=>['en'=>'Manage Leads & Quotations'],


            'NavSub11'=>['en'=>'Get Lead'],
            'NavSub12'=>['en'=>'Generate Quotation'],
            'NavSub14'=>['en'=>'View all Quotation'],
            'NavSub13'=>['en'=>'View all Leads'],

            'Navtitle2'=>['en'=>'Manage Invoices & Payments'],
            'NavSub21'=>['en'=>'Receive Payment'],
            'NavSub22'=>['en'=>'Generate Invoices'],
            'NavSub24'=>['en'=>'View all Payment'],
            'NavSub23'=>['en'=>'View all Invoices'],

            'Navtitle3'=>['en'=>'Manage Customers'],
            'NavSub31'=>['en'=>'Add New Customer'],
            'NavSub32'=>['en'=>'View all Customer'],

            'Navtitle4'=>['en'=>'Manage Templates'],
            'NavSub41'=>['en'=>'Add Quotation Templates'],
            'NavSub42'=>['en'=>'Add Invoices Templates'],
            'NavSub43'=>['en'=>'View all Quotation Templates'],
            'NavSub44'=>['en'=>'View all Invoices Templates'],


        ];

        return self::processDataForOut($finalData,$lang) ;
    }
    public static function processDataForOut($inData,$lang='en'){

        $outData=[];
        foreach ($inData as $id=>$data){
          //  dd(!array_key_exists($id,$outData) && array_key_exists($lang,self::$allowedLan));
            if(!array_key_exists($id,$outData) && in_array($lang,self::$allowedLan) && array_key_exists($lang,$data))$outData[$id]=$data[$lang];
        }

        return $outData;
    }
}
