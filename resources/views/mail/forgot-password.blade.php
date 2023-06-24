@extends('mail/mail')
@section('mail_title'){{'Email Verification'}}@endsection
@section('content')
<h1 style="text-align: center; font-weight: 700; font-size: 16px; ">Email Verification</h1>
<p>

    Hello {{ @$name }}, <br>
</p>
<p>We are glad to see you on board!</p>
<p>You have requested to reset your password.</p>
<p> Use this One Time Passcode to reset password </p>
<p>OTP :
    <span style="background-color: orange; color:black; border-radius: 8px; padding: 5px 20px;font-size: 25px;">
    <strong>{{ @$otp }}</strong>
    </span>
</p>
<!-- <p>Or</p>
<p>Please click on the account activation link below!</p> -->
<!-- <h3 style="font-size: 25px ; text-align:center;    color: #6c6cd5; padding: 5px;width: auto;margin:0;">Welcome</h3> -->
<!-- <a href="{{  @$url }}" target="_blank" style="overflow-wrap: break-word;">{{ @$url }}</a> -->
<br>

 

@endsection