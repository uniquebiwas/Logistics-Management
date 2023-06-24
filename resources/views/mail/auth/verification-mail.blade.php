@extends('mail/mail')
@section('mail_title'){{'Email Verification'}}@endsection
@section('content')
<h1 style="text-align: center; font-weight: 700; font-size: 16px; ">Email Verification</h1>
<p>
    Hello  {{ @$name }}, <br>
</p>
<p>You should now verify your e-mail address in order to activate your account with us.</p>
<!-- <p> Use this account activation code </p> -->
<!-- <p>Activation Code :
    <span style="background-color: orange; color:black; border-radius: 8px; padding: 5px 20px;font-size: 25px;">
    <strong>{{ @$otp }}</strong>
    </span>
</p> -->
<!-- <p>Or</p> -->
<p>Please click on the account activation link below!</p>
<!-- <h3 style="font-size: 25px ; text-align:center;    color: #6c6cd5; padding: 5px;width: auto;margin:0;">Welcome</h3> -->
<a href="{{  @$verification_url }}" target="_blank" style="overflow-wrap: break-word;">{{ @$verification_url }}</a>
<br>
 

@endsection