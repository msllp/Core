@extends('MS::core.layouts.root')
@section('body')

<?php
//dd($form);
$json=collect($form)->toJson();

?>


<msform :ms-data="{{$json}}"></msform>


        <form>

        </form>


@endsection
