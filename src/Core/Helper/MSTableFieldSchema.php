<?php


namespace MS\Core\Helper;


class MSTableFieldSchema
{
    private $name = null;
    private $vName=null;
    private $input='text';
    private $type='string';
    private $validation=[];
    private $FinalDataToOut=[];
    private $dbOff=false;
    private $addAction=null;
    private $relationToOther=[];
    private $defaultData=[];
    private $debug=false;
    public function __construct()
    {

    }

    public function n($name):object {
        $this->name=$name;
        return $this;
    }
    public function t($type):object {
        $this->type=$type;
        return $this;
    }
    public function vn($name):object  {
        $this->vName=$name;
        return $this;
    }
    public function i($type):object  {
        $this->input=$type;
        return $this;
    }
    public function nodb($bool=true):object {
        $this->dbOff=$bool;
        return $this;
    }

    public function required($bool=true):object{
        $this->validation['required']=$bool;
        return $this;
    }

    public function min($int):object {
        $this->validation['length']['minimum']=(int)$int;
        return $this;
    }

    public function max($int):object {
        $this->validation['length']['maximum']=(int)$int;
        return$this;
    }
    public function length($in):object {
        $this->validation['length']['is']=(int)$int;
        $this;
    }

    public function pattern($regx,$msg='is not Valid',$flag=''):object {
        $this->validation['format']=[
            'pattern'=> $regx,
            'flags'=> $flag,
            'message'=> $msg
        ];

        return$this;
    }

    public function onlyNumber($bool=true,$msg='is not valid number',$stric=true):object {
        if($bool)$this->validation['numericality']= ['strict'=> $stric,'greaterThan'=>0,'message'=>$msg];
        return$this;
    }

    public function addAction($actionId):object {
        $this->addAction=$actionId;
        return $this;
    }
    public function connectDB($namespace,$tableId,$valueColumn,$displayColumn){
        $str=implode(':',[$namespace,$tableId,implode('->',[$valueColumn,$displayColumn])]);
        $this->validation['existIn']=$str;
        return $this;
    }
    public function connectDBRaw($str){
       $this->validation['existIn']=$str;
        return $this;
    }

    public function flush():array {
        $this->proccessToOut();
        $dataToOut=$this->FinalDataToOut;
        $this->resetAllValue();
        return $dataToOut;
    }
    public function connectTo($inputName,$value="",$operator='='){
        $this->relationToOther[$inputName]=[
            'operator'=>$operator,
            'value'=>$value
        ];
        return $this;
        //dd($this);

    }

    public function resetAllValue(){

        $defalutValue=[
            'name'=>null,
            'vName'=>null,
            'input'=>'text',
            'type'=>'string',
            'validation'=>[],
            'FinalDataToOut'=>[],
            'dbOff'=>false,
            'addAction'=>null,
            'relationToOther'=>[],
            'defaultData'=>[]
        ];

        foreach ($defalutValue as  $k=>$v){
            if($this->$k !=$v)$this->$k=$v;
        }



    }

    public function giveData($namespace,$method,$key='BoolName',$value="BoolValue"){
        $this->defaultData=
            [
                'msdata'=>  $namespace::$method(),
                'text'=>$key,
                'value'=>$value

            ];

        return $this;
    }

    public function debugOn(){
        $this->debug=true;
        return $this;
    }
    public function proccessToOut():void {
        $array=[
            'name'=>$this->name,
            'type'=>$this->type,
            'input'=>$this->input,
        ];

        if($this->type=='UID'){
            $array['input']='UID';
            $array['type']='string';
        }

     //   if($this->debug)dd($array);

        switch ($array['input']){
            case 'number':
                //$this->pattern('^[a-zA-Z0-9]*$');
                $this->onlyNumber(true,'is not valid number',false);
                break;

            case 'text':
                if(!array_key_exists('format',$this->validation))  $this->pattern('^$|^\S[a-zA-Z0-9 ]*$','is not valid text');
                break;

            case 'UID':
                if(!array_key_exists('format',$this->validation))  $this->pattern('^$|^\S[a-zA-Z0-9_]*$','is not valid text');
                break;

            case 'email':
                $this->validation['email']=true;
                break;
        }
        if($this->vName!=null)$array['vName']=$this->vName;
        if($this->addAction!=null)$array['addAction']=$this->addAction;
        if($this->dbOff)$array['dbOff']=$this->dbOff;
        if(count($this->validation)>0)$array['validation']=$this->validation;
        if(count($this->relationToOther)>0)$array['relation']=$this->relationToOther;
        if(count($this->defaultData)>0)$array['validation']['verifyBy']=$this->defaultData;
       // if(count($this->defaultData)>0)dd($array);
        //dd($array);
      //  if($this->debug)dd($array);
        $this->FinalDataToOut=$array;
    }


}
