<?php


namespace MS\Core\Helper;


class MSRoute
{



    public $currentData=[];
    public $finalData=[];
    public $preFix=null;
    public function __construct($preFix=null)
    {
        $this->preFix=$preFix;
    }

    public function __call($method, $arguments)
    {

        $allowedFunction=['n','r','m','g','p'];

        if(!method_exists($this,$method) && in_array($method,$allowedFunction) && $method !="all" ){
            $str=reset($arguments);
            switch ($method){
                case 'n':
                    if(!array_key_exists('name',$allowedFunction))$this->currentData['name']=$str;
                    break;
                case 'r':
                    if(!array_key_exists('route',$allowedFunction))$this->currentData['route']=$str;
                    break;
                case 'm':
                    if(!array_key_exists('method',$allowedFunction))$this->currentData['method']=$str;
                    break;
                case 'g':
                    if(!array_key_exists('type',$allowedFunction))$this->currentData['type']='get';
                    $this->addToFinal();
                    break;
                case 'p':
                    if(!array_key_exists('type',$allowedFunction))$this->currentData['type']='post';
                    $this->addToFinal();
                    break;

            }


        }
        return $this;


    }

    public function addToFinal(){
        $this->finalData[]=$this->currentData;
        $this->currentData=[];
        return $this;
    }

    public function all(){
    return $this->finalData;
    }

}
