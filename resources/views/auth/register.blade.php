@extends('layouts.app')
@section('title', 'Vendor Registration')
@section('content')

<style>

    .body-bg {
      background-color: rgb(233,233,233);
        background-repeat: no-repeat;

    }

    .loginpanel, .signuppanel {
        padding: 15px;
        background: none;
        background: rgba(255, 255, 255, 0.85);
        border: 2px solid #ecedf0;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 8px 8px 21px -3px rgba(0,0,0,0.35);
        -moz-box-shadow: 8px 8px 21px -3px rgba(0,0,0,0.35);
        box-shadow: 8px 8px 21px -3px rgba(0,0,0,0.35);
        font-family: "Roboto";
    }
    .loginpanel, .signuppanel {
        border-radius: 16px;

    }

    body {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        background-color: #f8f8f8;


    }
    body, html {
        -webkit-font-smoothing: antialiased;
        -moz-font-smoothing: antialiased;
        -ms-font-smoothing: antialiased;
        -o-font-smoothing: antialiased;
        font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
        font: 100%/1.5em 'Roboto',sans-serif;
        margin: 0px;
        padding-bottom: 0px;
        background-color: rgb(233,233,233);
        -moz-background-size: cover;
        -webkit-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        color: #666;
        height:100%;
    }

    .user-title {
        color: #FFFfff;
        padding: 5px;
        margin: -20px -15px 20px;
        background-color: #404040;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .btn-colors {
        background: #3F4196;
        border: 2px solid rgba(255, 255, 255, 0.51);
        border-radius: 5px;
        color: #fff;
        font-size: 15px;
        width: 100%;
    }
    .login-icon{
        z-index: 10;
        margin-top: -25px;
        position: absolute;
        height: 83px;
        margin-left: 10px;
    }
    .icon-login {
        background: #357F50;
        border: 2px solid rgba(255, 255, 255, 0.51);
        border-radius: 5px;
        color: #fff;
        font-size: 15px;
        width: 100%;
    }
    a {
        color: #357F50;
        text-decoration: none;
    }
    .admission-style{

        color: #357F50;
        margin-top: 20px;
        margin-right: 25px;

    }

    .logo-style{
        height:50px; 
        margin-left: 20px;   
    }

    .power-style{

        height: 40px;
    }


    .footer-style{
        /*     position: fixed; */
        background: #357F50;
        width: 100%;
        bottom: 0;
        z-index: 10;
        font-size: 13px;
    }
    @media(max-width: 400px){
        .footer-style div p{
            padding: 5px  0px  0px  0px !important;
        }
    }
    @media(max-width:767px){
        .img-logo-sz    {
            width: 160px;
        }
        .footer-style div.text-left, .footer-style div.text-right{
            text-align: center!important;
        }
    }
    .footer-style div p{
        margin-bottom: 0px;
        color:#ffffff!important;

    }
    .footer-style div p a{
        color:#00DCFF!important;
        text-decoration: none;
    }
    /****************Responsive Design**************/
    @media screen and (max-width: 1280px) {
    }

    @media screen and (max-width: 1024px) {
    }

    @media screen and (min-width: 768px) {
    }

    @media screen and (max-width: 480px) {
        .admission-style {
            margin-top: 0px;
        }
    }

    @media screen and (max-width:360px){
    }

    @media screen and (max-width:320px){
    }



</style>

<div class="main-container">
    <div class="body-bg" >
        <div class="col-md-4 col-sm-3 col-xs-1"></div>
        <div class="loginpanel col-md-4 col-sm-6 col-xs-10">
            <span><img src="images/register-icon.png" class="login-icon"></span>
            <div class="text-center user-title">
                <p class="register-title"><strong>Registration Form</strong></p>
            </div>
            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-10 col-sm-10 col-xs-10">




                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" id="candidate_login"  method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="margin-top: 10px;">
                            <label for="example-nf-email">Enter User Name e.g. Arun</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <!--                             <input type="text" id="example-username" name="example-username" class="form-control" placeholder="your ID"> -->
                                <input id="name" name="name" placeholder="USER ID" class="form-control" type="text" value="{{old('name')}}"/>

                            </div>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                            <span class="text-success" id="available" style="display: none">
                                Loginid Available
                            </span> <span class="text-danger" id="notavailable"
                                          style="display: none"> Login not available, enter another name.
                            </span> <span id="loading" style="display: none"><i
                                    class="fa fa-spinner fa-spin"></i> </span>


                        </div>
                        <div class="form-group" style="margin-bottom: 2px;!important">
                            <label for="example-nf-password">Enter Valid Mobile No</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <span class="input-group-addon">+91</span>
<!--                                     <input type="number" id="example-number" name="example-number" class="form-control" placeholder="+91"> -->
                                <input id="password" name="mobile" placeholder="MOBILE NO " class="form-control" type="text" value=""/>
                            </div>
                        </div>

                        @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif

                        <div class="form-group" style="font-size: 15px; margin-bottom: 10px;!important">
                            <small style="color: black;">Note: Mobile No. will be used for future communication.</small>
                        <!--    <center><small style="color: black;">Contact us on admissions@intellinects.org</small></center> -->
                        </div>
                        <div class=" form-actions">
                            <div class="text-right"><button type="submit" class="btn btn-sm btn-colors">Submit</button> </div>                                      
                        </div>

                    </form>
                    <div class="form-group" style=" margin-top: 10px;color: black;">
                        <small>Only use Chrome, Mozilla FireFox, Safari and Internet Explorer version 9.0 or above. </small>
                    </div>
                </div>                                    
                <div class="col-md-1 col-sm-1 col-xs-1 "></div>
            </div>         
        </div>
        <div class="col-md-4 col-sm-3 col-xs-1 "></div>
        <span class="clearfix"></span>
    </div>

</div>
@include('resusable.footer')




@endsection
