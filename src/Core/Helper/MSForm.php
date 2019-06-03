<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 25-03-2019
 * Time: 04:35 AM
 */

namespace MS\Core\Helper;


class MSForm
{

    public $returnHTML =[
            '<div id="msapp" class="accordion">'
        ];

    public static $optionalStyleKeys=[
        'prefix'=>'prefix',
        'perfix'=>'perfix',
        'inputClass'=>'inputClass',
        'formClass'=>'formClass',
        'onlyInput'=>'inputOnly',

        ];

    public static $optionalStyleKeysWithDynamicValue=[
        'inputSize'=>'inputSize',

    ];
    public $namespace,$id,$perFix,$data,$msdb,$fields,$dbMaster;


    public function __construct(string $namespace,string $id=null,string $perFix=null,array $data=[])
    {

        $this->namespace=$namespace;
        $this->id=$id;
        $this->perFix=$perFix;
        $this->data=$data;
        $base="\\".$this->namespace."\\B";
        $this->dbMaster=$base::$tables[ $this->id];


    }

    public static function makeArrayForViewFromStyle(array $array,array $data) : array{

        foreach (self::$optionalStyleKeys as $key=>$value){
            if(array_key_exists('style',$data) &&  array_key_exists($key,$data['style']))
            {
                $array[$value]=$data['style'][$key];
            }
        }
        foreach (self::$optionalStyleKeysWithDynamicValue as $key=>$value){
            if(array_key_exists('style',$data) && array_key_exists($key,$data['style']))
            {
                switch ($key){
                    case "inputSize":
                        $strExploded=explode(".",$data['style'][$key]);

                        if(count($strExploded) > 1 ){

                            switch (count($strExploded)){

                                case 2:
                                    $array[$value]=
                                        implode(" ",
                                            [
                                                //implode("-",['col','xs',$strExploded[0]]),
                                                implode("-",['col','sm',$strExploded[0]]),
                                                implode("-",['col','md',$strExploded[1]]),
                                     //           implode("-",['col','lg',$strExploded[3]])
                                        ]
                                        )
                                    ;
                                    break;
                                case 3:
                                    $array[$value]=
                                        implode(" ",
                                            [
                                                //implode("-",['col','xs',$strExploded[0]]),
                                                implode("-",['col','sm',$strExploded[0]]),
                                                implode("-",['col','md',$strExploded[1]]),
                                                implode("-",['col','lg',$strExploded[2]])]
                                        )
                                    ;
                                    break;
                                case 4:
                                    $array[$value]=
                                        implode(" ",
                                        [implode("-",['col','xs',$strExploded[0]]),
                                        implode("-",['col','sm',$strExploded[1]]),
                                        implode("-",['col','md',$strExploded[2]]),
                                        implode("-",['col','lg',$strExploded[3]])]
                                        )
                                        ;
                                    break;

                            }


                        }else{
                            $array[$value]="col-".$data['style'][$key];
                        }
                        break;
                }



            }
        }

        return $array;

    }

    public function fromModel(MSDB $dbClass){
        $this->msdb=$dbClass;
      //  dd($this);
        $this->action=$this->fields=$this->msdb->model->ms_action;;
        $this->fields=$this->msdb->model->base_Field;
        $this->makeForm();

        return $this;

    }

    private function getFieldFromFields($name){
        $fields=$this->fields;
        $field=collect($fields)->where('name',$name);
        if($field->count()> 0){
            return $field->first();
        }



    }

    private function makeFieldsFromGroup($groupArray){
            $returnArray=[];

            foreach ($groupArray as $title=>$fieldsArray){
                $returnArray[]=[
                    'vName'=>$title,
                    'input'=>'gourpHeading',

                ];
                foreach ($fieldsArray as $fieldName){
                    $returnArray[]=$this->getFieldFromFields($fieldName);
                }

                $returnArray[]=[
                    'vName'=>$title,
                    'input'=>'gourpEnd',

                ];

            }
    return $returnArray;

    }
    private function makeForm(){

        if( array_key_exists('add',$this->action) ){
            $action=$this->action;
        }
        $fields=$this->fields;
        $getFields=false;
        if(array_key_exists('fieldGroup',$this->dbMaster)){
            $getFields=true;
            $fields=$this->makeFieldsFromGroup($this->dbMaster['fieldGroup'])  ;
              //dd($fields);
        }

        foreach ($fields as $rowArray){



            switch ($rowArray['input']){


                case 'locked':
                    if($this->checkFromHidden($rowArray))$this->locked($rowArray);
                    break;
                case 'generated':
                    if($this->checkFromHidden($rowArray))$this->generated($rowArray);
                    break;
                case 'text':
                    if($this->checkFromHidden($rowArray))$this->addOneline($rowArray);
                    break;
                case 'number':
                    if($this->checkFromHidden($rowArray))$this->addOneline($rowArray);
                    break;
                case 'textarea':
                    if($this->checkFromHidden($rowArray))$this->textarea($rowArray);
                    break;
                case 'email':
                    if($this->checkFromHidden($rowArray))$this->addOneline($rowArray);
                    break;
                case 'password':
                    if($this->checkFromHidden($rowArray))$this->addOneline($rowArray);
                    break;
                case 'date':
                    if($this->checkFromHidden($rowArray))$this->addOneline($rowArray);
                    break;
                case 'datetime':
                    if($this->checkFromHidden($rowArray))$this->datetime($rowArray);
                    break;
                case 'checkbox':
                    if($this->checkFromHidden($rowArray))$this->checkbox($rowArray);
                    break;
                case 'radio':
                    if($this->checkFromHidden($rowArray))$this->radio($rowArray);
                    break;
                case 'option':
                    if($this->checkFromHidden($rowArray))$this->option($rowArray);
                    break;


                case 'gourpHeading':
                    $data=[
                        'title'=>$rowArray['vName']
                    ];
                   // $this->returnHTML[]='<div class="accordion" id="accorinf_master">';
                    $this->returnHTML[]=view("MS::core.layouts.HTML.splitButtonStart")->with('data',$data)->render();


                    break;
                case 'gourpEnd':
                    $this->returnHTML[]=view("MS::core.layouts.HTML.splitButtonEnd")->render();

                    break;

                default:

                    if($this->checkFromHidden($rowArray))$this->text($rowArray);

                    break;


            }


        }


//        dd($this);
    }



    public function view(){
        //dd($this->returnHTML);
        $this->returnHTML[]='</div>';

        return view("MS::core.layouts.Form.formPlate")->with("form",implode("",$this->returnHTML));
        return implode("",$this->returnHTML);
    }

    private function addOneline(array $data){

        //dd($data);

        $this->returnHTML[]=view("MS::core.layouts.Form.input.oneline")->with('data',$data)->render();

    }

    private function text($data){

            $this->returnHTML[]=view("MS::core.layouts.Form.input.oneline")->with('data',$data)->render();


    }

    private function locked ($data){}
    private function generated ($data){

        $sClass=$this->namespace."\\F";

            $sMethod="::".$data['callback'];
       // dd($sClass . $sMethod);
            //  dd($input['callback']."()");
            //dd(call_user_func($sClass . $sMethod));
            $val=call_user_func($sClass . $sMethod);



        //$this->returnHTML[]=$val;



    }
    private function number ($data){}
    private function textarea ($data){}
    private function email ($data){}
    private function password ($data){}
    private function date ($data){}
    private function datetime ($data){}
    private function radio ($data){}
    private function checkbox ($data){}
    private function option ($data){}

    private function checkFromHidden($data){
        if(array_key_exists('hidden',$data) && $data['hidden'])return false;
            return true;
    }
}
