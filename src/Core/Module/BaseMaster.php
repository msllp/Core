<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 16-03-2019
 * Time: 04:19 AM
 */

namespace MS\Core\Module;


interface BaseMaster
{

    public static function getTable();

    public static function getConnection();

    public static function getField();

}