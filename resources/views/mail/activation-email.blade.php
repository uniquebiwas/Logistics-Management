@extends('mail/mail')
@section('mail_title'){{ 'Account Verification Email'}}@endsection
@section('mail-body')
<h1 style="text-align: center; font-weight: 700; font-size: 30px;">New Email Verification</h1>
<p>
	Dear {{@$fullname}}, <br>
	{{-- You have requested to change email address in <strong>{{route('index')}}</strong> in {{date('Y-m-d h:i a')}}. <br> --}}
	You should verify your email address in {{route('index')}}.
	<br>
	<strong> Email Address:</strong> {{@$email}}
	Here below a link has been attached with this email to confirm your email is valid. <br>
	<br>
	<br>
	<strong>Account Activation link : </strong>
	<a href="{{ @$verification_url }}" target="_blank" style="overflow-wrap: break-word;">{{ @$verification_url }}</a>
</p>
<br>

@endsection