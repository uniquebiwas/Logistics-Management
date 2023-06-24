<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Shivaya Edu World Pvt Ltd</title>
    <style>
        body {
            font-family: arial;
        }

    </style>
</head>

<body>
    <div style="width:100%; float:left;">
        <div style="width:750px; margin:0 auto;">
            <div style="width:100%; float:left;">

                <div style="width:50%; float:left">
                    <div
                        style="width:600px; float:left; font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:600;">
                        Shivaya Edu World Pvt Ltd (Educounsellors)</div>
                    <div
                        style="width:500px; float:left; margin:10px 0 25px 0; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                        Office No 205, Ansal Laxmi Deep Tower , District Center, Laxmi Nagar, New Delhi, Delhi 110092
                    </div>
                    <div style="width:700px; float:left; margin-bottom:5px;">
                        <div style="width:20%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            Mobile No. :</div>
                        <div style="width:50%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            +91 11-40-501928</div>
                    </div>
                    <div style="width:700px; float:left; margin-bottom:5px;">
                        <div style="width:20%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            Email id :</div>
                        <div style="width:50%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            info@educounsellors.org</div>
                    </div>
                    <div style="width:700px; float:left; margin-bottom:5px;">
                        <div style="width:20%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            Website:</div>
                        <div style="width:50%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            www.educounsellors.org</div>
                    </div>
                    <div style="width:700px; float:left; margin-bottom:5px;">
                        <div style="width:20%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            GST No :</div>
                        <div style="width:50%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            07ABACS1572M1Z4</div>
                    </div>
                    <div style="width:700px; float:left; margin-bottom:5px;">
                        <div style="width:20%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            PAN No :</div>
                        <div style="width:50%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
                            ABACS1572M</div>
                    </div>

                </div>



                <div style="width:50%; float:right; text-align: right;">
                    <div style="width:200px; float:right;">
                        <img src="{{  public_path('/assets/university/images/logo.png') }}" style="width:100%; height:auto" />
                    </div>

                    <div
                        style="width:100%; float:left; font-size:14px; margin:20px 0 5px 0; color:#999; font-family:Arial, Helvetica, sans-serif; font-weight:600;">
                        BILLED TO:</div>
                    <div
                        style="width:100%; float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:600;">
                        {{ @$billingInfo->personal_information['college_name'] }},
                        {{ @$billingInfo->address_information['city'] }}
                        {{ @$billingInfo->address_information['address_line_1'] }},
                         <br>
                         {{ @$billingInfo->address_information['country'] }}
                    </div>

                </div>



                <div style="width:100%; float:left; margin-top: 30px;">
                    <div
                        style="width:100px; float:left; font-size: 13px; font-family:Arial, Helvetica, sans-serif; line-height: 19px;">
                        INVOICE NUMBER<br>
                        <b>{{ @$billingInfo->id }}</b><br><br>

                        Issued Date:<br>
                        <b>{{ ReadableDate(@$billingInfo->created_at, 'yearmonthday') }}</b><br><br>

                        Purchased Date:<br>
                        <b>{{ ReadableDate(@$billingInfo->created_at, 'yearmonthday') }}</b><br><br>

                        Payment Status:<br>
                        <b>{{ @$billingInfo->payment_status }}</b>
                    </div>

                    <div style="width:600px; float:right;">
                        <table width="100%" border="0" cellspacing="2" cellpadding="6"
                            style="font:Arial, Helvetica, sans-serif">
                            <tr>
                                <th bgcolor="003664" scope="col" style="color:#fff;">Description</th>
                                <th bgcolor="003664" scope="col" style="color:#fff;">Amount</th>
                                <th bgcolor="003664" scope="col" style="color:#fff;">GST (18%)</th>
                                <th bgcolor="003664" scope="col" style="color:#fff;">Total Amount</th>
                            </tr>
                            <tr>
                                <td style="background-color: #F3F3F3; font-size: 14px;">
                                    {{ @$billingInfo->package_information['admission_category'] }} Membership fee</td>
                                <td style="background-color: #F3F3F3; font-size: 14px;">
                                    {{ @$billingInfo->package_information['actual_cost'] }}</td>
                                <td style="background-color: #F3F3F3; font-size: 14px;">
                                    {{ @$billingInfo->package_information['tax_amount'] }}</td>
                                <td style="background-color: #F3F3F3; font-size: 14px;">
                                    {{ @$billingInfo->package_information['total_amount'] }}</td>
                            </tr>

                            <tr>
                                <td bgcolor="F3F3F3"></td>
                                <td bgcolor="F3F3F3"></td>
                                <td style="background-color: #F3F3F3; font-size: 14px;"><b>Subtotal:</b></td>
                                <td style="background-color: #F3F3F3; font-size: 14px;">
                                    <b>{{ @$billingInfo->package_information['total_amount'] }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="F3F3F3"></td>
                                <td bgcolor="F3F3F3"></td>
                                <td style="background-color: #F3F3F3; font-size: 14px;"><b>Discount:</b></td>
                                <td style="background-color: #F3F3F3; font-size: 14px;"><b>0.000</b></td>
                            </tr>
                            <tr>
                                <td bgcolor="F3F3F3"></td>
                                <td bgcolor="F3F3F3"></td>
                                <td style="background-color: #F3F3F3; font-size: 14px;"><b>Invoice Total:</b></td>
                                <td style="background-color: #F3F3F3; font-size: 14px;">
                                    <b>{{ @$billingInfo->package_information['total_amount'] }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="F3F3F3"></td>
                                <td bgcolor="F3F3F3"></td>
                                <td style="background-color: #F3F3F3; font-size: 14px;">Payment Type: </td>
                                <td style="background-color: #F3F3F3; font-size: 14px;">
                                    {{ @$billingInfo->payment_information['payment_method'] }}</td>
                            </tr>
                        </table>

                    </div>
                </div>



                <div
                    style="width:75%; float:right; text-align: right; font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:600; margin:30px 20px 0 0;">



                    <div style="width:94%; margin-top:10px; float:left; background-color:#003664; padding:15px 20px;">

                        <div style="width:33.333%; float:left;">
                            <div style="float:left;">
                                <div style="width:10%; float:left; margin-right:10px;"><img
                                        src="{{ public_path('/assets/university/images/location.png') }}" />
                                </div>
                                <div
                                    style="width:80%; float:right; color:#9FB0C4; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:18px;">
                                    Office No 205, Ansal Laxmi Deep Tower , District Center, Laxmi Nagar, New Delhi,
                                    Delhi 110092</div>
                            </div>
                        </div>

                        <div style="width:33.333%; float:left;">
                            <div style="float:left;">
                                <div style="width:10%; float:left; margin-right:10px;"><img src="images/call.png" />
                                </div>
                                <div
                                    style="width:80%; float:right; color:#9FB0C4; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:18px;">
                                    011-40501928, <br />9999016731, 9999016732</div>
                            </div>
                        </div>

                        <div style="width:33.333%; float:left;">
                            <div style="float:left;">
                                <div style="width:10%; float:left; margin:0 10px 10px 0;">
                                    <img src="{{ public_path('/assets/university/images/mail.png') }}" />
                                </div>
                                <div
                                    style="width:80%; float:right; color:#9FB0C4; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:18px;">
                                    info@educounsellors.org</div>
                            </div>
                            <div style="float:left;">
                                <div style="width:10%; float:left;">
                                    <img src="{{ public_path('/assets/university/images/website.png') }}" />
                                </div>
                                <div
                                    style="width:80%; float:right; color:#9FB0C4; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:18px;">
                                    www.educounsellors.org</div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</body>

</html>
