@extends('MS::core.layouts.rootEmail')
@section('body')
<div >
    Hello, {{ (isset($data) && array_key_exists('name',$data))?$data['name']:'Test Name ' }}<br>
    <p style="display: block">
       <span style="display: block">Thank you for registering on O<sub>3</sub>ERP ! </span>
        <span style="display: block">In order to activate your account, please verify your e-mail address.</span>


    </p>
    <p style="display: block;padding-top: 5px;text-align: center">Your verification code</p>

    <strong style="user-select: all; display:block;text-align:center;background:#eeeeee;padding:10px;border-radius:2px;color:#959595;font-size:18px;font-weight:bold">{{(isset($data) && array_key_exists('otp',$data))?$data['otp']:'123456789 '}}</strong>
    <small style="display: block; font-size: 10px;text-align:center;padding-top:5px;color: rgba(255,0,0,0.4)">
        This OTP is valid for 2 hours only.
    </small>

</div>
@endsection
