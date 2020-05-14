<?php


namespace MS\Middlelwares;
use Closure;

class onlyAjaxRoute
{
    public function handle($request, Closure $next)
    {




        if(!$request->ajax())return $this->throwError();

        if(!$request->headers->has('MS-APP-Token'))return $this->throwError();

        if(!$this->checkValidMSAppToken($request))return $this->throwError('621');

        //dd($request);
        return $next($request);
    }

    protected function checkValidMSAppToken($r){
        $allowedToken=[
            'o3-website'=>"For O3 Website",
            'o3-backend'=>"For O3 Backend"
        ];

        $token=$r->headers->get('MS-APP-Token');
        $appId=$r->headers->get('MS-APP-ID');

        $token=\MS\Core\Helper\Comman::decodeLimit($token);

        if(array_key_exists($appId,$allowedToken) && $token==$appId)return true;
 
        return false;
    }
    protected function throwError($erID=''){
        $er=[
            '619'=>'Dont try to be smart . You are not only who think smart.',
            '621'=>'You are not permited to access.'
        ];
        return (array_key_exists($erID,$er))?response()->json($er[$erID],419):response()->json(reset($er),419);
    }

}
