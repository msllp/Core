<?php


namespace MS\Core\Helper;

use MS\Core\Helper\MSDB;

class MSLogin
{

    public $formData,$pageData,$msdb,$mPageData;
    public function __construct(MSDB $db,$pageData)
    {
        $this->mPageData=$pageData;
        $this->msdb=$db;
        $this->formData=[];
        $this->pageData=[];

    }

    public function displayLoginPageFromMSDB(){


        $this->pageData=$this->makeArrayForVueForPageData();

        $d=$this->pageData;

        return view("MS::core.layouts.MS.loginPage")->with("d",$this->jsonOut($d));

    }

    private function makeArrayForVueForPageData(){
        $f=[];

        $f=[
            'bgImg'=>asset('images/bg1.png'),
            'ClientIcon'=>asset('images/logo.png'),
            'MasterIcon'=>'',
            'formData'=>$this->makeArrayForVueForFormData(),
            'loginPostUrl'=>'',
            'CheckUsernamePostUrl'=>'',
        ];

a
        =0return $f;
    }
    private function makeArrayForVueForFormData(){

        $f=[];
        return $this->msdb->getDisplayFormArray('add_user');
        return $f;
    }

    private function jsonOut($d){
        return collect($d)->toJson();
    }


}
