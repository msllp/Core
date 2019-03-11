<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 11-03-2019
 * Time: 10:41 PM
 */

namespace MS\Core\Helper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');


/**
 * Class Comman
 * @package MS\Core\Helper
 */
class Comman
{


    public static function loadBack(){
        require_once(base_path('MS'.DIRECTORY_SEPARATOR .'B'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR ."Routes.php"));
    }


    public static function loadFront(){
        require_once(base_path('MS'.DIRECTORY_SEPARATOR .'F'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR ."Routes.php"));
    }


    /**
     * To Load Custom Location Route file
     * @param array $array['locationOfFile'=>'Location of Folder in MS']
     */
    public static function loadCustom($array=[]){

        if(count($array) > 0){
            array_key_exists('locationOfFile', $array)?require_once(base_path('MS'.DIRECTORY_SEPARATOR .implode(DIRECTORY_SEPARATOR,explode('.', $array['locationOfFile'])).'.php')):null;
        }else{
            require_once(base_path('MS'.DIRECTORY_SEPARATOR .'F'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR ."Routes.php"));
        }
    }

    public static function test(){
        return[

            'Status'=>200,
            'Msg'=>"Working good "
        ];
    }
}

