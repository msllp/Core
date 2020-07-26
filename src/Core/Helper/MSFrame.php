<?php


namespace MS\Core\Helper;



use MS\Mod\B\Mod4O3\L\App;

class MSFrame
{

   public function registerGroups($c,$d){
       foreach ($d as $v){
           $c->addGroup($v['name'],$v['data']);
       }

       return $c;

   }

   public function decodeMethodName($actionPath){


       $explodePath=explode('@',$actionPath);
       $class=$explodePath[0];
       $methodName=$explodePath[1];
       $explodeName=explode('_',$methodName);
       $data=[
            'class'=>$explodePath[0],
            'module'=>ucfirst($explodeName[2]),
            'method'=>$explodeName[3]
        ];
       return $data;
       dd($data);
   }

   public function getActionName(){
       $method=\Route::getCurrentRoute()->getActionName();
       $decodeMethod=$this->decodeMethodName($method);
       return  implode('@',[ $decodeMethod['class'],$decodeMethod['method'] ]);

   }

   public function checkPermission(){

        if(ms()->checkRootUser())return true;

        $perFix=implode('_',[ms()->rootId(),ms()->role()]);
        $c=new \MS\Mod\B\User4O3\L\SubUser ();
        $permission=$c->getUserRolePermissionsModel($perFix)->rowAll();
        $c=new App();
        return $c->checkPermission($this->getActionName(),$permission);


   }

   public function getModules(){
       return ['Sales','Purchase','Inventoy','Company','Accounts','Users'];
   }

   public function getDBTypes(){
       return ['Master','Config','Data'];
   }

   public function getPreFix(){
       $preFix='O3';
       return $preFix;
   }

   public function getDBs($dbTypes='sqlite'){
       $allowedTypes=['sqlite','aws'];
       if(!in_array($dbTypes,$allowedTypes))throw new \Exception('no DB Driver Found');
       $dev['aws']=[
           'driver'=>'mysql',
           'host'=>'o3-dev.csahz08vgvqp.ap-south-1.rds.amazonaws.com',
           'user'=>'admin',
           'pass'=>'MSadmin!123',
           'port'=>'3306'
       ];
       $dev['sqlite']=[
           'driver'=>'sqlite',
           'path'=>'MS/DB/Master',
       ];
       $production=[];
       $final=$dev[$dbTypes];
       $mod=$this->getModules();
       $types=$this->getDBTypes();
       $finlOut=[];
       $preFix=$this->getPreFix();
       foreach ($mod as $m){

           foreach ($types as $t){
                $name=implode('_',[$preFix,$m,$t]);
                switch ($dbTypes){
                    case 'aws':
                        $finlOut[$name]=[
                            'driver' => $final['driver'],
                            'host' => $final['host'],
                            'port' => $final['port'],
                            'database' => $name,
                            'username' => $final['user'],
                            'password' => $final['pass'],
                        ];
                        break;
                    case 'sqlite':
                        $finlOut[$name]=[
                            'driver' => $final['driver'],
                            'database' =>base_path(implode('/',[$final['path'],$name])),

                        ];
                        break;
                }

           }

       }


//           // 'unix_socket' => env('DB_SOCKET', '/tmp/mysql.sock'),
//            //'charset' => 'utf8mb4',
//           // 'collation' => 'utf8mb4_unicode_ci',
//            //'prefix' => '',
//           // 'prefix_indexes' => true,
//           // 'strict' => true,
//           // 'engine' => null,

       $finlOut['MS_Master']=[
           'driver' => 'sqlite',
           'database' => base_path('MS/DB/Master/MS_Master'),
           'prefix' => '',
           'foreign_key_constraints' => true,
       ];

       $finlOut['MS_UI']=[
           'driver' => 'sqlite',
           'database' => base_path('MS/DB/Master/MS_UI'),
           'prefix' => '',
           'foreign_key_constraints' => true,
       ];
       return $finlOut;

   }

}
