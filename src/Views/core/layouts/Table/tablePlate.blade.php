@extends('MS::core.layouts.root')
@section('body')

    <?php
    //dd($table);
    $json=collect($table)->toJson();

    ?>


    <msdatatable :ms-data="{{$json}}" ref="msTable"></msdatatable>




@endsection
