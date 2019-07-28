@extends('MS::core.layouts.root')
@section('body')

<?php
//dd($form);
$json=collect($form)->toJson();

?>


<msform :ms-data="{{$json}}" key="msFrom" ref="msFrom"></msform>


        <form>

        </form>


@endsection
