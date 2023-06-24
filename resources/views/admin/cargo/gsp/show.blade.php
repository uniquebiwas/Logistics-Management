<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GSP</title>

    <style>
        table {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 11px;
            width: 100%;
            border-collapse: collapse;
        }

        tr {}

        td {
            padding: 0;
            vertical-align: top;

        }

        th {
            padding: 0;
            vertical-align: top;
        }

        pre {
            font-family: 'Roboto', sans-serif;
            line-height: 12px;
            margin: 0;
            padding: 0;
        
        }

        textarea {
            font-family: 'Roboto', sans-serif;
            color: #fff;
            background-color: transparent;
            line-height: 12px;
        }

        @page {
            size: 210mm 297mm;
            margin: 13mm 5mm 12mm 18mm;
        }

        body,
        html {
            margin: 23px 10px 5px 35px;
        }

        /* Disable this for Printing */
        /* table, tr , td{
            border-top: 1px solid #000;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        } */

    </style>
</head>

<body>

    <table style="border-bottom:none;height:193px;">
        <tbody>
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <table width="100%">
                        <tbody>
                            <tr style="border-bottom:1px solid #000;">
                                <td style=";">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div style="height: 18px;"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:12px;">
                                                    <div style="height: 65px;">
                                                        <pre style="font-family: 'Roboto', sans-serif;padding-left:5px;margin-top:0px;">{!! $gsp->exporter_details !!}</pre>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="">
                                <td style=";">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div style="height: 25px;"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:12px;">
                                                    <div style="height:70px;">
                                                        <pre
                                                            style="font-family: 'Roboto', sans-serif;padding-left:5px;margin-top:0px;">{!! $gsp->consignee_details !!}</pre>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style="vertical-align: top;;height:193px;font-size: 11px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td colspan="2">&nbsp; <b style="font-size: 15px;letter-spacing: 2px;">&nbsp;</b></td>
                            </tr>
                            <tr>
                                <td style="text-transform: uppercase;
                                font-weight: bold;
                                text-align:center;
                                line-height: 1.2;" colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-transform: uppercase;
                                font-size: 11px;
                                text-align:center;
                                font-weight: bold;" colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px;
                                text-align:center;
                                font-weight: 600;
                            }" colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="
                                text-transform: uppercase;
                                font-weight: bold;
                                font-size: 12px;
                                text-align:center;
                                margin-top: 5px;" colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align: right;width:50%;
                                font-size: 13px;padding-top:16px;margin-top:5px;">&nbsp; <b
                                        style="margin:0 10px;">KTM</b> &nbsp;</td>
                                <td style="width:50%;"> </td>

                            </tr>
                            <tr>

                                <td style="text-align: center;" colspan="2">&nbsp;</td>

                            </tr>
                            <tr>
                                <td style="text-align: right;" colspan="2">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="border-bottom:none;height:189px;font-size: 12px;">
        <tbody>
            <tr>
                <td width="50%" style=";height:189px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <div style="height:10px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:5px;">
                                    {!! $gsp->transport !!}<br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style=";height:189px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    {!! $gsp->official_use !!}<br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="height: 280px;border-bottom:none;height:415px;">
        <thead>
            <tr>
                <th width="6%" style="height:67px;">&nbsp;</th>
                <th width="12.56%" style="height:67px;">&nbsp;</th>
                <th width="43.16%" style="height:67px;">&nbsp;</th>
                <th width="12.56%" style="height:67px;">&nbsp;</th>
                <th width="12.56%" style="height:67px;">&nbsp;</th>
                <th width="12.56%" style="">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center;vertical-align:top;width:6%;">
                    <div style="font-family: 'Roboto', sans-serif;">
                        <pre>{!! $gsp->item_no !!}</pre>
                    </div>
                </td>
                <td style="text-align:center;vertical-align:top;width:12.56%;">
                    <div style="font-family: 'Roboto',sans-serif;width:100%;">
                        <pre style="white-space: unset">{{ $gsp->package_marks }}</pre>
                    </div>
                </td>
                <td style="text-align:center;vertical-align:top;width:43.16%;">
                    <div style="font-family: 'Roboto',sans-serif;width:100%">
                        <pre > {!! $gsp->description_of_goods !!}</pre>
                    </div>
                </td>
                <td style="text-align:center;vertical-align:top;width:12.56%;">
                    <div style="font-family: 'Roboto', sans-serif;">
                        <pre> {!! $gsp->origin !!} </pre>
                    </div>
                </td>
                <td style="text-align:center;vertical-align:top;width:12.56%;">
                    <div style="font-family: 'Roboto', sans-serif;">
                        <pre> {!! $gsp->gross_weight !!}</pre>
                    </div>
                </td>
                <td style="text-align:center;vertical-align:top;width:12.56%;">
                    <div style="font-family: 'Roboto', sans-serif;">
                        <pre>{!! $gsp->invoice_data !!}
                        </pre>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="height:200px;">
        <tbody>
            <tr>
                <td width="50%" style="position: relative;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="" style="font-weight: 600;
                                font-size: 13px;margin-bottom:10px;">&nbsp;</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:22px;">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 125px;">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b style="position:absolute;left:40px;top:220px;">Date left</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style="position: relative;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="" style="font-weight: 600;
                                font-size: 13px;margin-bottom:10px;">&nbsp;</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:22px;height:18px;">


                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <b style="position:absolute;right:100px;top:100px;">
                                        <pre>{!! $gsp->produced_country !!}
                                        </pre>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="height:38px;">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;padding:10px;">
                                    <b style="position:absolute;right:100px;top:175px;">
                                        <pre>{!! $gsp->importing_country !!}</pre>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>


                                    &nbsp;

                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <b style="position:absolute;right:120px;top:220px;">
                                        <pre>{!! $gsp->export_date !!}</pre>
                                    </b>
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
