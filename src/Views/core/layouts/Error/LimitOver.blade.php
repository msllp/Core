@extends('MS::core.layouts.rootRaw')
@section('body')

    <?php
  //  dd($data);

    ?>


<div class="ms-error-box">

    <div class="ms-error-img"> <img src="{{asset('ms/error/limit.svg')}}"> </div>

    <h3 class="ms-error-text">Opps... You are not allowed to add {{ ucfirst(strtolower($data['which']))  }}</h3>
    <h4 class="ms-error-text">You can upgrade Your plan to add more {{ ucfirst(strtolower($data['which']))  }}</h4>
    <div class="ms-error-btn" v-on:click="clickFromTab({{\MS\Core\Helper\Comman::url('O3.Users.upgrade','Upgrade Plan')}})">
        <img src="{{asset('ms/error/upgrade.svg')}}">
        <span>Upgrade Your Plan</span>
        </div>

</div>




@endsection
