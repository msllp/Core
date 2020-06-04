<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 17-03-2019
 * Time: 01:14 PM
 */

if (!function_exists('array_key_first')) {
    /**
     * Gets the first key of an array
     *
     * @param array $array
     * @return mixed
     */
    function array_key_first(array $array)
    {
        return $array ? array_keys($array)[0] : null;
    }


}

function ms(){
    if (Cache::has('ms')) {
       $v=Cache::get('ms');
    }else{
        $v=new \MS\Core\Helper\MSMagic ();
        Cache::put('ms',$v, 600);
    }
    return $v;

}
function msRaw(){
    $v=new \MS\Core\Helper\MSMagic ();
    return $v;
}
