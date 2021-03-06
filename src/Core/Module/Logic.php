<?php


namespace MS\Core\Module;



class Logic
{

    private $methods=[];
    public $DB=[];
    public function __construct($data = [])
    {



        $this->DB=[
            'm'=>static::$c_m,
            'd'=>static::$c_d,
            'c'=>static::$c_c,
        ];
       // dd(get_object_vars  ($this));

        if (count($data)) foreach ($data as $k => $v) if (array_key_exists($k, static::$userConstructData) && gettype($v) == static::$userConstructData[$k]) $this->$k = $v;

    }


    public function __call($method,$arguments) {


        if(!method_exists($this,$method) && $method !="getTableRaw"){

            $setProp=get_object_vars  ($this);
            $methodName=str_replace("get", "",$method);
            $methodName=str_replace("Model", "",$methodName);
            $methodName=str_replace("migrate", "",$methodName);

            if(array_key_exists($methodName,$setProp)){

                if(strpos($methodName,$this->modPre) !== false && strpos($method,"Model")!==false){
                  //  dd($this->$methodName);
                    $tableId=$this->$methodName;
                    $namespace=implode('\\',['MS','Mod','B',static ::$modCode]);
                    $data=$arguments;
                    return self::getModel($namespace,$tableId,$data);
                }elseif (strpos($methodName,$this->modPre)!==false && strpos($method,"migrate")===0){
                    $tableId=$this->$methodName;
                    $namespace=implode('\\',['MS','Mod','B',static ::$modCode]);
                    $data=$arguments;
                    $m=self::getModel($namespace,$tableId,$data);
                    return $m->migrate();
                }
                else{
                    throw new \Exception(implode(' ',[$method,'not found in',get_called_class ()]),404);
                }
            }
        }


    }
    public static function makeTableRaw($inData=[])
    {

        $methodToCall = $inData;
        $c = new static();
        $d = [];
        foreach ($methodToCall as $method => $data) if (method_exists($c, $method)) $d = array_merge($d, $c->$method($data));
        return $d;

    }
    public static function fromController(array $methods)
    {
        $c = new static();


        if (count($methods) > 1 && count($methods) != 0) {

        } elseif (count($methods) != 0 && count($methods) == 1 ) {

            $method=reset($methods);
            if (array_key_exists('method', $method) && array_key_exists('data', $method)) {
                    //        dd(call_user_func([$c,$method['method']],$method['data']));

                //dd(count($methods) != 0 && count($methods) == 1);
                    return call_user_func([$c, $method['method']], $method['data']);
            }


        }


    }

    public function throwNextData($mod,$title,$route,$data=[]){
        $nextData=\MS\Core\Helper\Comman::makeNextData($mod,$title,route($route,$data));
        return \MS\Core\Helper\Comman::msJson([],$nextData,[]);
    }
    public function throwData(array $data,$status=200,$extra=[]){
        $err=[
            'msData'=>$data
        ];

        return response()->json($err,$status);
    }
    public function throwError($data,$status=419,$extra=[]){

        $err=[
            'errors'=>$data
        ];
        $err=array_merge($err,$extra);

        return response()->json($err,$status);
    }
    public function unSet($column, $d)
    {

        foreach ($column as $name) {
            if (array_key_exists($name, $d)) unset($d[$name]);
        }
        return $d;
    }

    public static function getModel($namespace,$tableId,$data=[])
    {
        if (count($data) > 0){

        }
        $tableId = implode('_',[static ::$modCode,$tableId]) ;
        $c = ms()->msdb($namespace, $tableId,$data);
        return $c;

    }

    public function migrateById($id, $data = [])
    {
        $idExplode = explode('_', $id);
        $tableId = (count($idExplode) > 0 && reset($idExplode) == static::$modCode) ?
            $id : implode('_', array_merge([static::$modCode, $id,]));
        $namespace=implode('\\',['MS','Mod','B',static ::$modCode]);
        $c = ms()->msdb($namespace, $tableId, $data);
        //dd();
        return ($c->checkTableExist())?false:$c->migrate();
    }

    public function migrateBulk(array $idswithCoonection,$sameNamespace=true):bool{


    }


}
