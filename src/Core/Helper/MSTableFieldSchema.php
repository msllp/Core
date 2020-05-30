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
    public function __construct()
    {

    }

    public function n($name):object {
        $this->name=$name;
        return $this;
    }
    public function t($type):object {
        if($type=='email')$this->validation['email']=true;
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
        $this;
    }

    public function max($int):object {
        $this->validation['length']['maximum']=(int)$int;
        $this;
    }
    public function length($in):object {
        $this->validation['length']['is']=(int)$int;
        $this;
    }

    public function pattern($regx,$msg='is not Valid'):object {
        $this->validation['format']=[
            'pattern'=> $regx,
            'flags'> "i",
            'message'=> $msg
        ];
    }

    public function onlyNumber($bool=true):object {
        if($bool)$this->validation['numericality']= ['strict'=> $bool];
        $this;
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

    public function flush():array {
        $this->proccessToOut();
        $dataToOut=$this->FinalDataToOut;
        $this->resetAllValue();
        return $dataToOut;
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
        ];

        foreach ($defalutValue as  $k=>$v){
            if($this->$k !=$v)$this->$k=$v;
        }



    }

    public function proccessToOut():void {
        $array=[
            'name'=>$this->name,
            'type'=>$this->type,
            'input'=>$this->input,
        ];
        if($this->vName!=null)$array['vName']=$this->vName;
        if($this->addAction!=null)$array['addAction']=$this->addAction;
        if($this->dbOff)$array['dbOff']=$this->dbOff;
        if(count($this->validation)>0)$array['validation']=$this->validation;

        $this->FinalDataToOut=$array;
    }


}
