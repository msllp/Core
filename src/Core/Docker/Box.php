<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 19-08-2019
 * Time: 02:49 AM
 */

namespace MS\Core\Docker;


class Box
{
public $services=[];


public function __construct()
{
}
public function makeFromImage(Image $image){
dd($image);
}

public function addService($data){
$this->services[$data['name']]=$data;
}


}
