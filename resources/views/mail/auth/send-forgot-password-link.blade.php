@extends('mail/mail')
@section('mail_title'){{'Reset Password'}}@endsection
@section('content')
<h1 style="text-align: center; font-weight: 700; font-size: 16px; ">Reset password</h1>
<p>

    Hello {{ @$name }}, <br>
</p>
<p>You have requested to reset your password. You can reset your password using link given below. </p>
<p> If you have not requested to reset password then you can skip this mail.</p>
<!-- <p> Use this account activation code </p> -->
<!-- <p>Activation Code :
    <span style="background-color: orange; color:black; border-radius: 8px; padding: 5px 20px;font-size: 25px;">
    <strong>{{ @$otp }}</strong>
    </span>
</p>
<p>Or</p> -->
<p>Please click on the link below to reset your password!</p>
<!-- <h3 style="font-size: 25px ; text-align:center;    color: #6c6cd5; padding: 5px;width: auto;margin:0;">Welcome</h3> -->
<a href="{{  @$reset_url }}" target="_blank" style="overflow-wrap: break-word;">{{ @$reset_url }}</a>
<br>
 

@endsection