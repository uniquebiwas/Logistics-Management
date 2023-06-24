@extends('mail/mail')
@section('mail_title'){{'Password Updated'}}@endsection
@section('content')
<h1 style="text-align: center; font-weight: 700; font-size: 16px; ">Password Updated</h1>
<p>

    Hello {{ @$name }}, <br>
</p>
<p>Your password has been updated successfully. </p>
<p> You can login now using updated login information.</p>
<p>
    If you have not updated your password, Contact to suppport.
</p>
 

@endsection