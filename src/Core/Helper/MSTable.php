<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 13-09-2019
 * Time: 03:35 AM
 */

namespace MS\Core\Helper;


use function foo\func;
use http\Env\Request;

class MSTable
{

    public $returnHTML =[];

    public $namespace,$id,$perFix,$data,$msdb,$fields,$dbMaster,$action;
    public $viewID=null;
    public $attachedAction=[];
    public $perPage=1;
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
           // dd($this);
            $vueData=[
                'n'=>'tableTitle',
                'fc'=>'tableColumns',
                'data'=>'tableData',

            ];

            if(array_key_exists($this->viewID,$this->dbMaster['MSViews'])){
         //       dd($this->dbMaster['MSViews'][$this->viewID]);

                $fArray[$vueData['n']]=$this->dbMaster['MSViews'][$this->viewID]['title'];
                $fArray[$vueData['fc']]=$this->makeArrayForColumns($this->dbMaster['MSViews'][$this->viewID]['groups'] );
               // dd($this->msdb->rowAll());
                //dd($this->dbMaster['MSViews'][$this->viewID]['paginationLink']);
                $fArray[$vueData['data']]=$this->msdb->MSmodel->paginate($this->perPage)->withPath(route($this->dbMaster['MSViews'][$this->viewID]['paginationLink']));

           // dd($this->msdb->MSmodel->paginate(1));
            }
        $fArray[$vueData['data']]->links();



            //$formName=$this;

            return $fArray;



    }


    private function makeArrayForColumns(array  $array){
//dd($array);
        $allFileds=[];

        foreach ($array as $groupId){

            if(array_key_exists($groupId,$this->dbMaster['fieldGroup'])){

                foreach ($this->dbMaster['fieldGroup'][$groupId] as $colName){

                    if(!array_key_exists($colName,$allFileds)){
                        $colD=collect($this->fields)->where('name',$colName)->first();

                        switch ($colName){

                            case 'created_at':
                                $colD['vName']='Generated on';
                                $colD['input']='date';
                                goto ms_make_array;
                                break;
                            case 'updated_at':
                                $colD['vName']='Updated on';
                                $colD['input']='date';
                                goto ms_make_array;
                                break;


                            default:
                                ms_make_array:
                                $allFileds[$colName]=
                                    [
                                        'vName'=>$colD['vName'],
                                        'type'=>$colD['input']
                                    ];
                                break;
                        }


                    }
                }

            }



        }
        return $allFileds;
        //dd($allFileds);
        //dd(collect($$this->fields)->where('name',));

dd($array);

    }


    public function makeTable(){

        //dd($this->dbMaster['MSViews']);
        if(array_key_exists($this->viewID,$this->dbMaster['MSViews'])){
            $this->returnHTML['fromV']= $this->makeArrayForVue($this->dbMaster['MSViews'][$this->viewID]);
        }else{

        }




    }


   // public function

    public function view(){

        return view("MS::core.layouts.Table.tablePlate")->with("table",$this->returnHTML);
    }

}
