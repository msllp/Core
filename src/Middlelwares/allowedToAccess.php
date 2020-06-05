<?php


namespace MS\Middlelwares;

use Closure;

class allowedToAccess
{
    public function handle($request, Closure $next){

        $valid=ms()->do()->checkPermission();

        if(!$valid)return $this->throwError('621');


        return $next($request);

}

    protected function throwError($erID=''){
        $er=[
            '619'=>'Dont try to be smart . You are not only who think smart.',
            '621'=>'You are not permited to access.'
        ];
        return (array_key_exists($erID,$er))?response()->json($er[$erID],419):response()->json(reset($er),419);
    }


}
