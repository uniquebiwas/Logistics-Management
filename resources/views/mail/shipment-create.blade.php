@extends('mail/mail')
@section('mail_title'){{ 'Account Verification Email'}}@endsection
@section('mail-body')
<h1 style="text-align: center; font-weight: 700; font-size: 30px;">New Email Verification</h1>
<p>
	Dear Customer, <br>
    Kindly note that your Shipment has been checked-in at: {{@$appsettings_name}}
	<br>
    <p>Shipment Checked-in</p>
	
</p>
<br>

@endsection