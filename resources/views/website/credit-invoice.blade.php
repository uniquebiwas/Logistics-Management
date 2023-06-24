<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PDF File</title>
    <link rel="stylesheet" href="">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;

        }

        * {
            font-family: 'Montserrat', sans-serif !important;
        }

        b {
            font-weight: 500;
        }
        #datatable th{
            margin: 0;
            padding: 0;
            font-size: 13px;
        }

        #datatable td{

            font-size: 13px;
        }

        @page {
            /* size: 210mm 297mm; */
            margin: 13mm 10mm 13mm 10mm;

        }

    </style>
</head>

<body>
    <table
        style="font-family: 'Montserrat', sans-serif;font-size: 14px;border-collapse: collapse;margin:auto;width:100%;background:#fff;border-bottom:2px solid #000;padding-bottom:5px;">
        <tbody>
            <tr>
                <td width="100px" style="vertical-align:bottom;"><img src="img/logo.png" alt="images"
                        style="max-width: 160px;vertical-align:middle;padding:5px 5px 20px;"></td>
                <td width="255px" style="text-align: center;vertical-align:middle;padding:5px;">
                    <span
                        style="text-align: center;display: block;margin-left:-30px;font-size:32px;">{{ config('settings.name') }}</span>
                    <span
                        style="text-align: center;display: block;margin-left:-30px;">{{ config('settings.address') }}</span>
                    <span
                        style="text-align: center;display: block;margin-left:-30px;">finance@airlogisticsgroup.com.np</span>
                    <span
                        style="text-align: center;display: block;margin-left:-30px;">{{ config('settings.phone')[0]['phone_number'] }}</span>
                    <span style="text-align: center;display: block;margin-bottom: 10px;margin-left:-30px;">Pan No:
                        {{ config('settings.pan') }}</span>
                </td>
                <td width="120px" style="vertical-align:bottom;padding:5px 0px;">
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="text-align: right;"> <b
                                        style="color: #6b0b0c;font-size: 40px;font-weight: 600;letter-spacing: .5px;text-transform: uppercase;vertical-align: bottom;text-align:right;">Credit Note</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="font-family: 'Montserrat', sans-serif;font-size:14px;;width:100%;margin-bottom:5px;">
        <tbody>
            <tr>
                <td width="70%">
                    <table>
                        <tbody>

                            <tr>
                                <td style="vertical-align:top"><b>Customer A/C Name:</b></td>
                                <td style="vertical-align:top"> NEPAL CRAFTS CENTER

                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top"><b>Address:</b></td>
                                <td style="vertical-align:top">
                                    <span style="text-transform: capitalize">Mahalaxmi, Kathmandu, Nepal</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Telephone No:</b></td>
                                <td>984319555</td>
                            </tr>
                            <tr>
                                <td><b>Customer Pan No:</b></td>
                                <td>110821832</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="30%">
                    <table style="margin-right: 0; margin-left: auto;">
                        <tbody>
                            <tr>
                                <td><b>Credit Note No:</b></td>
                                <td><b>123</b></td>
                            </tr>

                            <tr>
                                <td><b>Date:</b></td>
                                <td>
                                   12/8/2022
                                </td>
                            </tr>
                            <tr>
                                <td><b>Miti:</b></td>
                                <td>12/8/2022</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="font-family: 'Montserrat', sans-serif;font-size: 14px;border-collapse: collapse;margin-top:15px;"
        width="100%">
        <tr>
            <th style="text-align:center;font-weight:normal;padding:15px;font-size: 16px;padding-top:35px;">We have
                credited your account
                for the following services</th>
        </tr>
    </table>
    <table style="font-family: 'Roboto', sans-serif;font-size: 14px;border-collapse: collapse;width:100%;max-width:100%;" id="datatable">

        <thead>
            <tr>
                <th
                    style="width:4%;padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    SN</th>
                <th style="width:25%;padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Particular
                </th>
                <th
                    style="width:40%;pxpadding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Description
                </th>

                <th style="width:21%;padding:2px 2px;border:1px solid #000;vertical-align:middle;">
                    Reference(If any)
                </th>
                <th style="width:10%;padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Amount</th>

            </tr>
        </thead>
        <tbody>
            @php
                // $total = bcdiv($invoice->awbs->sum('amount'), 1, 2);
            @endphp
            {{-- @foreach ($invoice->awbs as $key => $awb) --}}
                <tr>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        1</td>
                    <td
                        style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;text-transform:capitalize">
                        Particulars

                    </td>
                    <td
                        style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;text-transform:capitalize">
                       Descriptions
                    </td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                       Reference if any
                    </td>

                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        123
                    </td>
                </tr>
            {{-- @endforeach --}}

            <tr>
                <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;"
                    colspan="3"><b>Remarks: </b> some</td>
                <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;">
                    <b>Total Amount NPR:</b>
                </td>
                <td style="padding:3px 3px;border:1px solid #000;vertical-align:middle;text-align:center;">
                   123</td>
                {{-- <td style="padding:3px 3px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    123</td>
                <td style="padding:3px 3px;border:1px solid #000;vertical-align:middle;text-align:center;">
                   123
                </td>
                <td style="padding:3px 3px;border:1px solid #000;vertical-align:middle;text-align:center;">
                   12345</td> --}}
            </tr>
            <tr>
                <td style="padding:15px 10px;border:1px solid #000;vertical-align:middle;border-top:none;" colspan="5">
                    <b>Amount in Words:</b>
                    <span
                        style="text-transform:uppercase;font-style:italic">ABCD
                        only</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="font-family: 'Montserrat', sans-serif;font-size: 14px;border-collapse: collapse;margin:auto;width:100%;">
        <tbody>
            <tr>
                <td style="padding:0px 7px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="line-height: 19px;font-size:16px;width:80%;"></td>
                                <td style="text-align: center; vertical-align:top;;font-size:13pt;width:20%;"
                                    rowspan="2"><br><br>_______________________<br>
                                    Account Department<br>
                                    Air Logistics Group</td>
                            </tr>
                            <tr>
                                <td style="line-height:20px;">
                                    <ul style="margin:0;padding:0;">

                                    </ul>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>


    <div
        style="font-family: 'Montserrat', sans-serif;font-size:14px;text-align: center;margin-top:40px;font-weight:500;">
        This is computer generated invoice no signature and stamp required.
    </div>
    <div style="font-family: 'Montserrat', sans-serif;font-size:14px;text-align: center;">
        <p style="margin: 0;">2022 &copy; Copyright Air Logistics Group Pvt. Ltd.. All Rights Reserved</p>
        <p style="font-size:13pt;margin:0;">www.algxpress.com</p>
    </div>
    <script type="text/php">
        if ( isset($pdf) ) {  $font = $fontMetrics->get_font("helvetica", "500");$pdf->page_text(800, 1150, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0)); }
                            </script>
</body>


</html>
