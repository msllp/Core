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
        $allowed=['www.o3erp.com','o3erp.com',];

        $debugAllowed=['web.o3erp.ms','www.web.o3erp.ms','app.o3erp.ms','www.app.o3erp.ms','192.168.0.110'];
        $fAllowed=array_merge($allowed,$debugAllowed);
        $orgin=explode('//',$request->root())[1];
        $orgin=($request->headers->get('Origin') !=null)? explode('//',$request->headers->get('Origin'))[1]:$orgin;
        
        //dd($request->headers->has('MS-APP-Token'));
        $fAllowed=array_merge($allowed,$debugAllowed);

        $debug=1;
        //dd(explode('//',$request->root()));
        $orgin=explode('//',$request->root())[1];

    $checkArray=\MS\Mod\B\Mod\F::checkRouteExist($request);
//dd($request);
if($checkArray['pathFound'] or !$debug)return $next($request);

if($debug)return $next($request);
return response()->json(['msg'=>'Opps System can not found your target or your not allowed to reach target']);

    }

}
