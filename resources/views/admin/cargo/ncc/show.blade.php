<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{ public_path('front/css/cargo.css') }}"> --}}

    <style>
        table {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            width: 100%;
            margin:0;
            border-collapse: collapse;
        }

        tr {

        }

        td {
            padding: 0;
            vertical-align:top;

        }

        th {
            padding: 0;
            vertical-align: top;
        }

        pre {
            font-family: 'Roboto', sans-serif;
            line-height: 10px;
        }
        @page {
            size: 210mm 297mm;
            margin: 13mm 3mm 10mm 18mm;
        }

        body,
        html {
            margin: 30px 5px 5px 30px;
        }
        /* Disable this for printing */
        /* table, tr, td{
            border: 1px solid #000;
        } */
    </style>

</head>

<body>

    <table style="height:306px;">
        <tbody>
            <tr>
                <td width="50%" style="vertical-align:top;">
                    <table width="100%">
                        <tbody>
                            <tr style="">
                                <td style="height:163px;vertical-align:top;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">&nbsp;</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:51px;vertical-align:top;">
                                                    <pre>{!! $ncc->exporter_details !!}</pre>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;font-size:12px;">
                                                    <table width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="50%">&nbsp;</td>
                                                                <td width="50%">{!! $ncc->exporter_registration_no !!}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%">&nbsp;</td>
                                                                <td width="50%">{!! $ncc->firm_registration_no !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%">&nbsp;</td>
                                                                <td width="50%">{!! $ncc->place_and_data !!}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-top:1px solid #000;">
                                <td style="height: 120px;vertical-align:top;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div style="height: 30px;"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:51px;vertical-align:top;">
                                                    <pre>{!! $ncc->consignee_details !!}</pre>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style="vertical-align:top;">
                    &nbsp;
                </td>
            </tr>
        </tbody>
    </table>

    <table style="height:64px;">
        <tbody>
            <tr>
                <td width="50%" style="">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                <div style="height: 35px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="">{!! $ncc->transport !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <div style="height: 35px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="">{!! $ncc->license_no !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>


    <table style="height:314px;margin-top:20px;">
        <thead>
            <tr>
                <th width="12.5%"
                    style="text-align:center;font-weight:normal;">
                    &nbsp;</th>
                <th width="37.5%"
                    style="text-align:center;font-weight:normal;">
                    &nbsp;
                </th>
                <th width="14.58%"
                    style="text-align:center;font-weight:normal;padding-top:20px;padding-bottom:15px;"> {{ $ncc->currency }}</th>
                <th width="10.93%"
                    style="text-align:center;font-weight:normal;padding-top:20px;padding-bottom:15px;">{{ $ncc->unit }}</th>
                <th width="11.97%"
                    style="text-align:center;font-weight:normal;">
                    &nbsp;</th>
                <th width="12.50%"
                    style="text-align:center;font-weight:normal;">
                    &nbsp;</th>
            </tr>
        </thead>
        <tbody style="padding-top: 10px;">
            <tr>
                <td width="12.5%" style="text-align:center;vertical-align:top;padding:5px;">
                 {!! $ncc->package_marks !!}
                </td>
                <td width="37.5%" style="text-align:center;vertical-align:top;padding:5px;">
                    {!! $ncc->description_of_goods !!}</td>
                <td width="14.58%" style="text-align:center;vertical-align:top;padding:5px;">
                    {!! $ncc->value !!}</td>
                <td width="10.93%" style="text-align:center;vertical-align:top;padding:5px;">
                    {!! $ncc->quantity !!}
                </td>
                <td width="11.97%" style="text-align:center;vertical-align:top;padding:5px;">
                    {!! $ncc->production !!}</td>
                <td width="12.50%" style="text-align:center;vertical-align:top;padding:5px;">{!! $ncc->invoice_data !!}</td>
            </tr>
        </tbody>
    </table>

    <table style="height:32px;">
        <tbody>
            <tr>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="" style="font-weight:500;width: 45px;">&nbsp;</label></td>
                                <td>{!! $ncc->value_in_words !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="height:257px;">
        <tbody>
            <tr>
                <td width="50%" style="height:257px;vertical-align:top;padding:10px;">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="padding-bottom:5px;"><label for=""
                                                        style="font-weight:500;">&nbsp;</label></td>
                                            </tr>
                                            <tr>
                                                <td style="height:55px;vertical-align:top;">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:65px;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top:5px;width:80px;">&nbsp;</td>
                                                <td style="padding-top:5px;text-align:center;"><div style="height:10px;"></div></td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">{!! $ncc->declaration_name !!}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">{!! $ncc->declaration_title !!}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">{!! $ncc->export_date !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style="height:257px;vertical-align:top;padding:10px;">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="padding-bottom:5px;"><label for=""
                                                        style="font-weight:500;">&nbsp;</label></td>
                                            </tr>
                                            <tr>
                                                <td style="height:55px;vertical-align:top;">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:65px;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top:5px;width:80px;">&nbsp;</td>
                                                <td style="padding-top:5px;text-align:center;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">Sample Name</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">Sample Title</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:5px;">&nbsp;</td>
                                                <td style="padding-top:5px;">Sample Date</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
