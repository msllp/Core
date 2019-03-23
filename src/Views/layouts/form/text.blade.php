<?php

$formClass="form-group";
$labelClass=false;
$inputClass="form-control";
$vData=false;
if(array_key_exists("vData",$data)){

    if(array_key_exists("size",$data['vData'])){
        $formClass=$formClass. " ".$data['vData']['size'];
        $vData['size']=$data['vData']['size'];
    }


    if(array_key_exists("labelClass",$data['vData'])){
        $labelClass= $data['vData']['labelClass'];
        $vData['labelClass']=$data['vData']['labelClass'];
    }

    if(array_key_exists("inputClass",$data['vData'])){
        $inputClass= $inputClass." ".$data['vData']['inputClass'];
        $vData['inputClass']=$data['vData']['inputClass'];
    }

}

if(array_key_exists("vName",$data)) $data['vName']=$data['name'];
if(array_key_exists("desc",$data)) $data['desc']="Enter" . $data['vName'];

?>



<div class="{{ $formClass  }}" title="{{$data['desc']}}">
    @if($vData && array_key_exists('labelClass',$vData))
        <label class="{{ ""  }}}">{{ $data['label']  }}</label>
    @else
        <label>{{ $data['label']  }}</label>
    @endif

    <input class="{{  $inputClass  }}" placeholder="Enter {{ $data['vName']  }} here">

</div>