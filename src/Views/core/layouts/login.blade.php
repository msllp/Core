@extends('MS::core.layouts.root')
@section('body')
<form class="form-signin card text-center" >

    <img class="mb-4 card-img-top" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

    <div class="card-body" id="msapp">
<?php

        $array=[
            'name'=>"password",
            'vName'=>"Password",
            'prefix'=>"cogs",
            'perfix'=>"rupee-sign",
            'inputOnly'=>true,
            'validation'=>[
                'type'=>'password',
                'minSize'=>'1',
                'required'=>1
            ],


        ];
        $arrayJson=collect($array)->toJson();

        ?>
        <h1 class="h3 mb-3 font-weight-normal card-title">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <inputtext :ms-data="{{$arrayJson}}"     ></inputtext>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block card-link" type="submit">Sign in</button>
            <p class="mt-3  text-muted card-subtitle">© 2017-2019</p>

        </div>

    </div>
</form>

    <script type="text/javascript">



    </script>
{{--<script src="https://cdn.jsdelivr.net/npm/vue"></script>--}}
@endsection
