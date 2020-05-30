<?php


namespace MS\Core\Module;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use BadMethodCallException;
use function GuzzleHttp\Psr7\str;

class MasterController extends BaseController
{
    use  DispatchesJobs, ValidatesRequests;

    public function __construct()
    {

    }

    public function __call($method, $arguments)
    {

        if(!method_exists($this,$method) && strpos($method,'__')!==false ) {

            $exMethod=explode('_',$method);
            $exMethod=array_slice($exMethod,2);
            $childClass=get_class($this);
            $exChildClass=explode('\\',$childClass);
            array_pop($exChildClass);
            $rootClass=ucfirst($exMethod[0]);

            $classMethod=$exMethod[1];

           // dd($classMethod);
            if(count($exMethod)>2){
                //dd($this->middleware('onlyAjax')->only($method));
                $error=[];
                for ($i=2;$i< count($exMethod);$i++){
                    if(end($error)!=null) return response()->json(end($error)->getOriginalContent(),end($error)->status()  );
                    switch ($exMethod[$i]){
                        case 'api':
                            $c=ms()->getMiddleware('api');
                            dd($c);
                            $error[]=$c->handle(Request::getFacadeRoot(),function ()use($error){
                                //  dd($this);
                            });
                            break;
                        case 'onlyuser':
                            $c=new \MS\Middlelwares\onlyForUsers() ;
                            $error[]=$c->handle(Request::getFacadeRoot(),function ()use($error){
                                //  dd($this);
                            });
                            break;
                    }

                }

                dd($error);
            }
            $nameSpace=implode('\\',array_merge($exChildClass,['L',$rootClass]));
            $request=Request::getFacadeRoot();
           // dd(Request::);
            $data=[
                'r'=>$request,
                'para'=>$arguments
            ];
            return $nameSpace:: fromController([['method' =>$classMethod, 'data' => $data]]);

        }

        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
        }

}
