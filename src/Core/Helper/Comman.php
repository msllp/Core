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
use phpDocumentor\Reflection\Types\Boolean;

define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');


/**
 * Class Comman
 * @package MS\Core\Helper
 */
class Comman
{


    public static function checkAllTrueArray(array $a):bool{
        $er=[];
        foreach ($a as $k=>$v){
          //  dd($v);
            if($v)$er[]=$k;
        }
    //    dd(count($er)>0);
        if(count($er)>0)return true;
        return false;
    }
    public static function makeNextData($mod,$text,$url):array {

        return [

            "modCode"=>$mod,
            "modDView"=>$text,
            "modUrl"=>$url,
        ];
    }

    public static function checkNGetOnlyDiffrent($old,$new):array {
        $fArray=[];
        $old=reset($old);
      //  dd($old);

        foreach ($new as $k=>$v){
            //dd($v == $old[$k]);
            //if($k=='MSPassword')dd($v!='null');
           // var_dump($k.": ".array_key_exists($k,$old).",".(gettype($v)=='string').",".($v!=null).",".($v!= $v));
        if(array_key_exists($k,$old) && (gettype($v)=='string') &&  ($v!=null) && ($v!='null') && ($v!='') && ($v!=' ')  && ($v!= $old[$k]) )$fArray[$k]=$v;
        }
        return $fArray;

    }

    public static function loadBack(){
        require(base_path('MS'.DIRECTORY_SEPARATOR .'B'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR ."Routes.php"));
    }


    public static function loadFront(){
        require(base_path('MS'.DIRECTORY_SEPARATOR .'F'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR ."Routes.php"));
    }


    public static function coreBack(){
        $bMod=['Users'];
        $path=implode(DIRECTORY_SEPARATOR,['vendor','msllp','modules','src','Modules','B','Routes.php']);
        require(base_path($path));
    }

    /**
     * To Load Custom Location Route file
     * @param array $array['locationOfFile'=>'Location of Folder in MS']
     */
    public static function loadCustom($array=[],$end='0',$master=false){
if($array['locationOfFile']=='Users.R'){

}
if($master && array_key_exists('locationOfFile', $array)){

    $array['locationOfFile']=implode(DIRECTORY_SEPARATOR,explode('.',$array['locationOfFile']));
    $array['locationOfFile']= implode(DIRECTORY_SEPARATOR,['vendor','msllp','modules','src','Modules','B',$array['locationOfFile'].".php",]);
   //dd($array);
    require (base_path($array['locationOfFile']));
    $end='donothing';
    // dd($array);
}
        if(count($array) > 0){
          switch ($end){
              case '0':
                  array_key_exists('locationOfFile', $array)?require(base_path('MS'.DIRECTORY_SEPARATOR .implode(DIRECTORY_SEPARATOR,explode('.', $array['locationOfFile'])).'.php')):null;
                  break;
              case 'b':
                  array_key_exists('locationOfFile', $array)?require(base_path(implode(DIRECTORY_SEPARATOR,['MS','B','M']).DIRECTORY_SEPARATOR .implode(DIRECTORY_SEPARATOR,explode('.', $array['locationOfFile'])).'.php')):null;
                  break;
              case 'f':
                array_key_exists('locationOfFile', $array)?require(base_path(implode(DIRECTORY_SEPARATOR,['MS','F','M']).DIRECTORY_SEPARATOR .implode(DIRECTORY_SEPARATOR,explode('.', $array['locationOfFile'])).'.php')):null;


                  break;

              case 'donothing':

                  break;
          }

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
                $characters = '456';
                break;

            case '1':
                $characters = '123456789';
                break;

            case '2':
                $characters = 'abcdefghijklmnopqrstuvwxyz';
                break;

            case '3':
                $charactmarge_databaseers = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
        //var_dump($code);


        $r1=self::random(1,'patern');
        $r2=self::random(1,'patern');
        $r3=self::random(1,'patern');


        $codeGarbage1=substr($code, $r1, 2);
        $codeGarbage2=self::random($r2,5);
        $codeGarbage3=self::random($r3,5);


        return $r3.$codeGarbage1.$codeGarbage3.$code.$codeGarbage2.$r2;
    }

    /**
     * To decode url friendly string
     * @param $str
     * @return string
     */
    public static function decode($str): string {

        $r1=substr($str,0,1)+3;
        $r2=substr($str,-1,1)+1;
      //  var_dump($str);


        $code=substr($str, $r1);
        //dd(substr($code,0 ,-$r2));
        $code=substr($code, 0   ,-$r2);
      //  var_dump($code);
       // $code=substr($code, 0, $r2);
   // dd(base64_decode ($code));
//        $code.="==";
        //dd(base64_decode ($code));
        return base64_decode ($code);
    }

    public static function test(){
        return[

            'Status'=>200,
            'Msg'=>"Working good "
        ];
    }

    ///For Database setting for Modules
    ///
    ///

    public static function marge_database($Config){

        $loadArray=config('database.connections');
        $loadArray=array_merge($loadArray,self::loadDBForModule($Config));
      //  dd($loadArray);
        \Config::set('database.connections',$loadArray);

    }


    public static function loadDBForModule($module){

        $m="_Master";
        $d="_Data";
        $basePath='MS'.DIRECTORY_SEPARATOR.'DB'.DIRECTORY_SEPARATOR.'Master'.DIRECTORY_SEPARATOR;
        $loadArray=[];

        $return[$module.$m]=[
            'driver' => 'sqlite',
            'database' => base_path($basePath.$module.$m),
            'prefix' => '',
        ];

        $return[$module.$d]=[
            'driver' => 'sqlite',
            'database' => base_path($basePath.$module.$d),
            'prefix' => '',
        ];
        $loadArray=array_merge($loadArray,$return);

        return $loadArray;

    }

    public function getAllTable():array {
        dd(\DB::connection($this->model->getConnectionName())-> getDoctrineSchemaManager()->listTableNames());
        return \DB::connection($this->model->getConnectionName());
    }

    public static function load_Route($mCode,$master=false){
        $class='';
        if($master)$class=implode('\\',['MS','Mod']).'\\';
        $class.=implode('\\',[$mCode,"B"]);

        $r=$class::$route;
        $dv="@";
        $controller="\\".$class::$controller;
      //  dd($controller);
       // dd($r);
        foreach ($r as $key=>$link){

            $ex=explode(':',$link['method']);

            if(count($ex)>1){
            $vNamespace=$ex[0];
            $actionString=$ex[1];
            $actionEx=explode('.',$actionString);

            $lastV=last($actionEx);

            $methodEx=explode('@',$lastV);
            $actionEx[array_key_last ($actionEx)]=$methodEx[0];
            $method=last($methodEx);
           // dd($actionEx);
            $actionString=implode("\\",$actionEx);
            $found=0;
                $routeArray=[];
            switch ($vNamespace){
                case "MS":
                    $vNamespace="MS\Core";
                    $found=1;

                    $routeArray=[
                        'Helper.MSSign.check'=>"core/signRequest",
                    ];


                    break;
            }

            if($found){
                $finalActionString="\\".implode('\\',[ $vNamespace,$actionString ])."@".$method;
            }else{
                $finalActionString="\\".implode('\\',[ $actionString ])."@".$method;
            }
                $method=$finalActionString;
            //dd(implode('.',array_merge($actionEx,[ last($methodEx) ])));
//dd($routeArray);
  //              dd(array_key_exists(implode('.',array_merge($actionEx,[ last($methodEx) ])),$routeArray));
                if(($link['route'] == "::")&& array_key_exists(implode('.',array_merge($actionEx,[ last($methodEx) ])),$routeArray)  ){

                    $link['route']=$routeArray[implode('.',array_merge($actionEx,[ last($methodEx) ]))];
                }
                if (!array_key_exists('type',$link) || ($link['type']!="post")){
                    $link['type']='post';
                }

                //dd($link);
            }else{
                $method=$controller.$dv.$link['method'];
            }



            switch ($link['type']){

                case 'get':
                    \Route::get($link['route'],$method)->name($link['name'])->middleware(\MS\Middlelwares\checkValidRoute::class);
                    break;

                case 'post':
                    \Route::post($link['route'],$method)->name($link['name']);
                    break;

                case 'put':
                    \Route::put($link['route'],$method)->name($link['name']);
                    break;

                case 'update':
                    \Route::patch($link['route'],$method)->name($link['name']);
                    break;

                case 'delete':
                    \Route::delete($link['route'],$method)->name($link['name']);
                    break;



                default:
                    \Route::get($link['route'],$method)->name($link['name']);
                    break;
            }

        }
    }

    public static function proccessReqNGetSideNavDataForDashboard($r,$data=[],$getVeriData=[]){
        $input=$r->all();
        $error=[];
        $returnArray=[
            'msg'=>'Opps I am Computer not Human.'

        ];
        if(array_key_exists('accessToken',$input))$input['accessToken']=\MS\Core\Helper\Comman::decode($input['accessToken']);
        if( (count($getVeriData)>0) && array_key_exists('accessToken',$getVeriData) &&  ($input['accessToken']!=$getVeriData['accessToken'])){
         //dd($input);
            $error['accessTokenNotVerified']='Sorry , I am not Human you can not bribe me.';
        }
        if(array_key_exists('accessToken',$input) && array_key_exists('type',$input) && array_key_exists('find',$input)){

            $returnArray['msg']='We finding Data';


            switch ($input['type']){
                case 'json':

                    switch ($input['find']){

                        case 'sidebar':
                            if(count($error)>0){
                                $returnArray['msg']=implode(' , ',$error);
                                $returnArray['items']=[];
                            }else{

                                $returnArray['msg']='We Have Data';
                                $returnArray['items']=$data;


                            }



                            return response()->json($returnArray,200);
                            break;


                    }

                    break;
            }

        }
        if(count($error)>0){

            $returnArray['msg']=implode(' , ',$error);
            $returnArray['items']=[];

        }else{

            return response()->json($returnArray,418);
        }

     //   return response()->json($returnArray,418);

    }
}

