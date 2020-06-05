<?php


namespace MS\Middlelwares;
Use Closure;


class onlyForUsers
{

    public function handle($request, Closure $next)
    {
      //  dd($request->url());
    //    dd($request->session()->all());
        if(!\MS\Mod\B\User4O3\F::checkUserLogin())return $this->throwError('621');
        $user=\MS\Mod\B\User4O3\F::getUser();
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
