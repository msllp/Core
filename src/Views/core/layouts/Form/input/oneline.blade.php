@extends('MS::core.layouts.rootJS')

@section('body')
<?php
//dd($data);
$array=[
    'name'=>$data['name'],
    'type'=>$data['input'],
    //'vName'=>$data['vName'],
    //'prefix'=>"lock text-info",
    //'perfix'=>"asterisk text-danger",
    //'inputOnly'=>true,
    //'required'=>true,
    'validation'=>[
        // 'minSize'=>5,
        'required'=>1
    ],
    //'inputClass'=>[],
    //'formClass'=>[],



];


$array=\MS\Core\Helper\MSForm::makeArrayForViewFromStyle($array,$data);


//dd($array);
if (array_key_exists('vName',$data))$array['vName']=$data['vName'];
if (!array_key_exists('vName',$array))$array['vName']=$data['name'];

if(array_key_exists('style',$data)){



}

if(array_key_exists('validation',$data)){

if(array_key_exists( 'required',$data['validation']) && $data['validation'] ['required'])
    (array_key_exists('perfix',$array))?$array['perfix'].= " fa-asterisk text-danger":$array['perfix']= "asterisk text-danger";


}


$arrayJson=collect($array)->toJson();

?>



    <inputtext :ms-data="{{$arrayJson}}"     ></inputtext>


@endsection
