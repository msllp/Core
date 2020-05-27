@extends('MS::core.layouts.root')
@section('body')

    <?php

    $jsonData=(isset($data))?collect($data)->toJson():'{}';

    ?>

    <makedataformsdb :ms-data="{{$jsonData}}"></makedataformsdb>
@endsection
