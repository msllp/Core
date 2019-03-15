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


    /**
     * To Load Custom Location Route file
     * Avalaible $type Random Ranges
     *  1 Number
     *  2 Lower a to z
     *  3 Lower a to z
     *  4 Lower a to z + Lower a to z
     *  5 Lower a to z + Lower a to z + Number
     * @param integer $count = 4 (Default)
     * @param integer $type = 1 (Default)
     * @return string
     */
    public static function random($count=4,$type=1): string {
        $randstring=[];
        switch ($type) {
            case'patern':
                $characters = '123';
                break;

            case '1':
                $characters = '0123456789';
                break;

            case '2':
                $characters = 'abcdefghijklmnopqrstuvwxyz';
                break;

            case '3':
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;

            case '4':
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;


            case '5':
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;

            default:
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
        }


        for ($i = 0; $i < $count; $i++) {
            $randstring[]= $characters[rand(0, strlen($characters)-1)];
        }
        return implode('', $randstring) ;
    }

    /**
     * To encode url friendly string
     * @param $str
     * @return string
     */
    public static function encode($str): string {
        $code=base64_encode ($str);
        $code=substr($code, 0, -2);
        // dd($code);
        return $code.self::random(5,5);
    }

    /**
     * To decode url friendly string
     * @param $str
     * @return string
     */
    public static function decode($str): string {
        $code=substr($str, 0, -5);
        $code.="==";
        return base64_decode ($code);
    }

    public static function test(){
        return[

            'Status'=>200,
            'Msg'=>"Working good "
        ];
    }
}

