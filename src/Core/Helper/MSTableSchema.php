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







    /**
     * @return mixed
     */
    public function getTableId()
    {
        return $this->tableId;
    }

    /**
     * @param mixed $tableId
     */
    public function setTableId($tableId)
    {
        $this->tableId = $tableId;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param mixed $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getFields()
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
    public function getFieldGroup()
    {
        return $this->fieldGroup;
    }

    /**
     * @param mixed $fieldGroup
     */
    public function setFieldGroup($fieldGroup)
    {
        $this->fieldGroup = $fieldGroup;
    }

    /**
     * @return mixed
     */
    public function getValidationMessage()
    {
        return $this->validationMessage;
    }

    /**
     * @param mixed $validationMessage
     */
    public function setValidationMessage($validationMessage)
    {
        $this->validationMessage = $validationMessage;
    }

    /**
     * @return mixed
     */
    public function getFieldGroupMultiple()
    {
        return $this->fieldGroupMultiple;
    }

    /**
     * @param mixed $fieldGroupMultiple
     */
    public function setFieldGroupMultiple($fieldGroupMultiple)
    {
        $this->fieldGroupMultiple = $fieldGroupMultiple;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getMSforms()
    {
        return $this->MSforms;
    }

    /**
     * @param mixed $MSforms
     */
    public function setMSforms($MSforms)
    {
        $this->MSforms = $MSforms;
    }

    /**
     * @return mixed
     */
    public function getMSViews()
    {
        return $this->MSViews;
    }

    /**
     * @param mixed $MSViews
     */
    public function setMSViews($MSViews)
    {
        $this->MSViews = $MSViews;
    }

    /**
     * @return mixed
     */
    public function getMSLogin()
    {
        return $this->MSLogin;
    }

    /**
     * @param mixed $MSLogin
     */
    public function setMSLogin($MSLogin)
    {
        $this->MSLogin = $MSLogin;
    }

    /**
     * @return mixed
     */
    public function getModId()
    {
        return $this->modId;
    }

    /**
     * @param mixed $modId
     */
    public function setModId($modId)
    {
        $this->modId = $modId;
    }

    /**
     * @return mixed
     */
    public function getModNameSpcae()
    {
        return $this->modNameSpcae;
    }

    /**
     * @param mixed $modNameSpcae
     */
    public function setModNameSpcae($modNameSpcae)
    {
        $this->modNameSpcae = $modNameSpcae;
    }

}
