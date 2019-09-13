<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 13-09-2019
 * Time: 03:35 AM
 */

namespace MS\Core\Helper;


class MSTable
{

    public $returnHTML =[];

    public $namespace,$id,$perFix,$data,$msdb,$fields,$dbMaster,$action;
    public $viewID=null;
    public $attachedAction=[];

       /**
        * MSForm constructor.
        * @param \MS\Core\Helper\string $namespace
        * @param \MS\Core\Helper\string|null $id
        * @param \MS\Core\Helper\string|null $perFix
        * @param array $data
        */
    public function __construct(string $namespace, string $id=null, string $perFix=null, array $data=[])
    {

        $this->namespace=$namespace;
        $this->id=$id;
        $this->perFix=$perFix;
        $this->data=$data;
        $base="\\".$this->namespace."\\B";
        $this->dbMaster=$base::getModuleTables()[$this->id];
        // $this->actionButton=[];


        foreach ($data as $v=>$k){

            switch ($v){

                case 'viewID':
                    $this->viewID=$k;
                    break;

                default:
                    break;

            }

            //    dd($this);

        }




    }

    public function fromModel(MSDB $dbClass,$data=[]){
        $this->msdb=$dbClass;
        $this->action=$this->fields=$this->msdb->model->ms_action;;
        $this->fields=$this->msdb->model->base_Field;
        if(count($data)>0)$this->newForm=false;
        $this->makeTable();
        return $this;
    }

    public function makeArrayForVue($array){
            $fArray=[];

            return $fArray;



    }


    public function makeTable(){

        //dd($this->dbMaster['MSViews']);
        if(array_key_exists($this->viewID,$this->dbMaster['MSViews']))
        $this->returnHTML['fromV']= $this->makeArrayForVue($this->dbMaster['MSViews'][$this->viewID]);



    }


   // public function

    public function view(){

        return view("MS::core.layouts.Table.tablePlate")->with("table",$this->returnHTML);
    }

}
