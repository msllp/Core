<?php


namespace MS\Core\Helper;


class MSCache
{
    public $globalKey='ms_app_data';
    public $msdbModelKey='msdb_models';
    public $NotAllowedKey=['msdb_models'];

    public function __construct()
    {
        $this->default();

    }

    public static function getClassFromMagic(){
        if(\Cache::has('msCacheClass')  ){
            $v=\Cache::get('msCacheClass');
           $v->default();
        }else{
            $v=new self();
            \Cache::put('msCacheClass',$v);
        }
        return $v;
    }

    private function default(){
        $this->setDefault();
        $this->setDefaultMSDB();
    }

    private function setDefault(){
        if(!\Cache::has($this->globalKey))\Cache::put($this->globalKey,[]);
    }
    private function setDefaultMSDB(){
        $d=$this->all();
        if(!array_key_exists($this->msdbModelKey,$d))$this->set($this->msdbModelKey,[],true);;
    }
    private function reset(){
        \Cache::put($this->globalKey,[]);
    }

    public function all(){
     $d=\Cache::get($this->globalKey);

     return $d;
    }

    public function set($k,$v,$allow=false):void {
        $allData=$this->all();
        $oldDataCount=count($allData);
        if(($allow || !in_array($k,$this->NotAllowedKey)))$allData[$k]=$v;
        \Cache::put($this->globalKey,$allData);
    }

    public function get($k,$allow=false){
        $allData=$this->all();
        if(($allow || !in_array($k,$this->NotAllowedKey)) && array_key_exists($k,$allData))return $allData[$k];
    }

    public function flush(){
        $this->reset();
    }

    public function setFromMSDB($tableName,$class){

        $allTableModels=$this->get($this->msdbModelKey,true);
        $allTableCount=count($allTableModels);
        if(!array_key_exists($tableName,$allTableModels))$allTableModels[$tableName]=$class;
        $this->set($this->msdbModelKey,$allTableModels,true);
    }
    public function getFromMSDB($tableName){
        $allTableModels=$this->get($this->msdbModelKey,true);
        if(array_key_exists($tableName,$allTableModels))return $allTableModels[$tableName];

    }

    public function hasMSDB($k){
        $allTableModels=$this->get($this->msdbModelKey,true);
        return array_key_exists($k,$allTableModels);
    }




}
