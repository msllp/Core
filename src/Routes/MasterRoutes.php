<?php






Route::prefix(config('MS.backend_prefix'))->group(function () {

//    Route::get('/', function () {
//        return redirect()->action('\B\Panel\Controller@index');
//    });
    MS\Core\Helper\Comman::loadBack();


});


