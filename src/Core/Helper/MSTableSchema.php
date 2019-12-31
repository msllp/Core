<?php
namespace MS\Core\Helper;
//TODO Make table schema For Table
use phpDocumentor\Reflection\Types\Boolean;

class MSTableSchema {

    public $tableId,$tableName,$connection,
           $fields,$fieldGroup,$validationMessage,
           $fieldGroupMultiple,$action,
           $MSforms,$MSViews,$MSLogin;

    private $modId,$modNameSpcae;

    private static $allowedKeys=[
        'tableId'=>'tableId',
        'tableName'=>'tableName',
        'connection'=>'connection',
        'fields'=>'fields',
        'fieldGroup'=>'fieldGroup',
        'validationMessage'=>'validationMessage',
        'fieldGroupMultiple'=>'fieldGroupMultiple',
        'action'=>'action',
        'MSforms'=>'MSforms',
        'MSViews'=>'MSViews',
        'MSLogin'=>'MSLogin'


    ];

    private static $requireKeys=[
        'tableId'=>'Test',
        'tableName'=>'Test',
        'connection'=>'MS_Core',
        'fields'=>[
//            [
//            'name'=>'UniqId',
//            'vName'=>'ID',
//            'type'=>'string',
//            'input'=>'text',
//            "validation"=>['required'=>true,]
//        ]
        ],
    ];

    private static $allowedKeysFields=[
        'name','vName','type','input','validation'
    ];

    private static  $requireKeysFields=[
        'name','type'
    ];

    public function __construct($data=[]){
        foreach (self::$allowedKeys as $setName){
            if (array_key_exists($setName,$data))$this->$setName=$data[$setName];
        }
        foreach (self::$requireKeys as $key=>$dValue){
            if($this->$key==null)$this->$key=$dValue;
        }

    //dd($this);

    }

    public function finalReturnForTableFile(){
        $d=[];
        foreach (self::$allowedKeys as $setName){
            //var_dump($setName);
           // var_dump($this->$setName);
            if($setName !='tableId'){
                if(property_exists ( $this,$setName ) && $this->$setName !=null) $d[$this->getTableId()][$setName]=$this->$setName;
            }else{
                $d[$this->$setName]=[];
                //
            }

        }

        dd($d);
        return $d;
    }


    public function addGroup($groupid){
        $fg=$this->getFieldGroup();
        if(is_array($fg) && !array_key_exists($groupid,$fg)){
            $fg[$groupid]=[];
        }elseif($fg==null){
            $fg=[$groupid=>[]] ;
        }
        $this->setFieldGroup($fg);
        return $this;
    }

    public function addField($groupId,$fields){
        $fg=$this->getFieldGroup();
        $f=collect($this->getFields());
        foreach ($fields as $field)
        if( is_array($fg)  &&
            ( array_key_exists($groupId,$fg) && $f->where('name','=',$field)->count()>0 )
            && !in_array($field,$fg[$groupId])
        )$fg[$groupId][]=$field;
        $this->setFieldGroup($fg);
        //dd($this);
        return $this;
    }

    public function addAction($acId,$acData){
            $ac=$this->getAction();
            if($ac==null)$ac=[];
        //    dd(!array_key_exists($acId,$ac));
            if(is_array($ac) && !array_key_exists($acId,$ac))
            {
                $ac[$acId]=$acData;
            }

            $this->setAction($ac);
            return $this;
    }

    public function addForm($formId){
        $mf=$this->getMSforms();
        if(is_array($mf) && !array_key_exists($formId,$mf)){
            $mf[$formId]=[];
        }elseif($mf==null){
            $mf=[$formId=>[]] ;
        }
        $this->setMSforms($mf);
        return $this;
    }
    public function addTitle4Form($formId,$title){
        $mf=$this->getMSforms();

        if(is_array($mf) && array_key_exists($formId,$mf) )$mf[$formId]['name']=$title;

        $this->setMSforms($mf);
        return $this;

    }

    public function addGroup4Form($formId,$groupId){
        $mf=$this->getMSforms();
        $fg=$this->getFieldGroup();
//dd($fg);
        foreach ($groupId as $group)//dd(is_array($mf) && array_key_exists($formId,$mf) && array_key_exists($group,$fg));
        if(is_array($mf) && array_key_exists($formId,$mf) && array_key_exists($group,$fg) )$mf[$formId]['groups'][]=$group;
        $this->setMSforms($mf);
        return $this;


    }

    public function addAction4Form($formId,$actionId){
        $mf=$this->getMSforms();
        $fg=$this->getAction();
        if($fg==null)$fg=[];
        foreach ($actionId as $action)//dd($fg);
            //dd(is_array($mf) && is_array($fg) && array_key_exists($formId,$mf) && array_key_exists($action,$fg));
            if(is_array($mf) && is_array($fg) && array_key_exists($formId,$mf) && !array_key_exists($action,$fg) )$mf[$formId]['actions'][]=$action;
        $this->setMSforms($mf);
        return $this;
    }

    public function addIcon4Form(){

    }





    /**
     * @return mixed
     */
    private function getTableId()
    {
        return $this->tableId;
    }

    /**
     * @param mixed $tableId
     */
    private function setTableId($tableId)
    {
        $this->tableId = $tableId;
    }

    /**
     * @return mixed
     */
    private function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param mixed $tableName
     */
    private function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return mixed
     */
    private function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    private function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    private function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields=[])
    {
        $d=$this->filterFields($fields);

        if ($this->checkFields($d))$this->fields[] = $d;

    }

    private function checkFields($d) {
        if ((count($d)> (count(self::$requireKeysFields)-1) ) && collect($this->getFields())->where('name','=',$d['name'] )->count() <1  )return true;
        return false;
    }
    private function filterFields($d){
        $fD=[];
        foreach (self::$allowedKeysFields as $keName){
            if(array_key_exists($keName,$d)) $fD[$keName]=$d[$keName];
        }
        return $fD;
    }

    /**
     * @return mixed
     */
    private function getFieldGroup()
    {
        return $this->fieldGroup;
    }

    /**
     * @param mixed $fieldGroup
     */
    private function setFieldGroup($fieldGroup)
    {
        $this->fieldGroup = $fieldGroup;
    }

    /**
     * @return mixed
     */
    private function getValidationMessage()
    {
        return $this->validationMessage;
    }

    /**
     * @param mixed $validationMessage
     */
    private function setValidationMessage($validationMessage)
    {
        $this->validationMessage = $validationMessage;
    }

    /**
     * @return mixed
     */
    private function getFieldGroupMultiple()
    {
        return $this->fieldGroupMultiple;
    }

    /**
     * @param mixed $fieldGroupMultiple
     */
    private function setFieldGroupMultiple($fieldGroupMultiple)
    {
        $this->fieldGroupMultiple = $fieldGroupMultiple;
    }

    /**
     * @return mixed
     */
    private function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    private function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    private function getMSforms()
    {
        return $this->MSforms;
    }

    /**
     * @param mixed $MSforms
     */
    private function setMSforms($MSforms)
    {
        $this->MSforms = $MSforms;
    }

    /**
     * @return mixed
     */
    private function getMSViews()
    {
        return $this->MSViews;
    }

    /**
     * @param mixed $MSViews
     */
    private function setMSViews($MSViews)
    {
        $this->MSViews = $MSViews;
    }

    /**
     * @return mixed
     */
    private function getMSLogin()
    {
        return $this->MSLogin;
    }

    /**
     * @param mixed $MSLogin
     */
    private function setMSLogin($MSLogin)
    {
        $this->MSLogin = $MSLogin;
    }

    /**
     * @return mixed
     */
    private function getModId()
    {
        return $this->modId;
    }

    /**
     * @param mixed $modId
     */
    private function setModId($modId)
    {
        $this->modId = $modId;
    }

    /**
     * @return mixed
     */
    private function getModNameSpcae()
    {
        return $this->modNameSpcae;
    }

    /**
     * @param mixed $modNameSpcae
     */
    private function setModNameSpcae($modNameSpcae)
    {
        $this->modNameSpcae = $modNameSpcae;
    }

}
