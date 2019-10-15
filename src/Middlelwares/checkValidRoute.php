<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 11-10-2019
 * Time: 03:02 AM
 */
namespace MS\Middlelwares;

use Closure;

class checkValidRoute{



    public function handle($request, Closure $next)
    {
        $debug=1;
        if($debug)return $next($request);
    $checkArray=\MS\Mod\B\Mod\F::checkRouteExist($request);

if($checkArray['pathFound'] or !$debug)return $next($request);

if($debug)return $next($request);
return response()->json(['msg'=>'Opps System can not found your target or your not allowed to reach target']);

    }

}
