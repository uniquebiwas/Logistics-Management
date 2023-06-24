@php
$type = Str::lower(request('type'));
$color = '#f5d8d8';
if ($type == 'draft') {
    $color = '#d8ddf7';
}
if ($type == 'original') {
    $color = '#daf1da';
}
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hbl Pdf</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            /* background-color: {{ $color }}; */
        }

        table {
            font-size: 10px;
            font-family: 'Roboto', sans-serif;
            border-collapse: collapse;
        }

        pre {
            font-family: 'Roboto', sans-serif;
            line-height: 12px;
            font-size: 11px;
            margin: 0;
        }

        label {
            font-size: 11px;
            font-weight: normal;
            margin-bottom: 3px;
            display: block;
        }

        p {
            font-size: 10px;
            line-height: 12px;
        }

        .non-nego {
            background: red;
        }

        .original {
            background: black;
        }

        .draft {
            background: pink;
        }
        body{
            margin:0px;
            padding:50px;
            background-color: {{ $color }}; 
        }
        

    </style>
</head>


<body>
    <table width="100%">
        <tbody>
            <tr>
                <td
                    style="font-size:22px;text-align:center;text-transform:uppercase;font-weight:600;color:#690b0c;padding-bottom:10px;">
                    House Bill of Lading</td>
            </tr>
        </tbody>
    </table>
    <table width="100%" style="border:1px solid #000;border-bottom:none;">
        <tbody>
            <tr>
                <td width="50%"
                    style="vertical-align:top;border-right:1px solid #000;padding:0;border-top:1px solid #000;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td colspan="2"
                                    style="vertical-align:top;padding:5px;border-bottom:1px solid #000;height:94px;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label style="font-weight:500;">Shipper's Name and Address:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;">
                                                    <pre>{!! $hbl['shipper'] !!}</pre>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="vertical-align:top;padding:5px;border-bottom:1px solid #000;height:94px;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Consignee Name and
                                                        Address:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;">
                                                    <pre>{!! $hbl['consignee'] !!}</pre>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="vertical-align:top;padding:5px;">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Notify:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;">
                                                    {!! $hbl['notify'] !!}
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%"
                                    style="vertical-align:top;padding:5px;border-right:1px solid #000;border-top:1px solid #000;height:40px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Pre Carriage by:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;">
                                                    {!! $hbl['preCarriageBy'] !!}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="50%"
                                    style="vertical-align:top;padding:5px;border-top:1px solid #000;height:40px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Mode Means of
                                                        Transport:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:15px;vertical-align:top;">
                                                    {!! $hbl['transportMode'] !!}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid #000;">
                                <td width="50%"
                                    style="vertical-align:top;padding:5px;border-right:1px solid #000;border-top:1px solid #000;height:40px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Place of Receipt:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;">
                                                    {!! $hbl['placeOfReceipt'] !!}
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="50%"
                                    style="vertical-align:top;padding:5px;border-top:1px solid #000;height:40px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Port of Loading:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;padding-top:0px;">
                                                    {!! $hbl['portOfLoading'] !!}
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid #000;">
                                <td width="50%"
                                    style="vertical-align:top;padding:5px;border-right:1px solid #000;border-top:1px solid #000;height:40px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Port of Discharge:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;">
                                                    {!! $hbl['portOfDischarge'] !!}
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="50%"
                                    style="vertical-align:top;padding:5px;border-top:1px solid #000;height:40px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Port of Delivery:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align:top;padding-top:0px;">
                                                    {!! $hbl['portOfDelivery'] !!}
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="vertical-align:top;padding:5px;border-top:1px solid #000;height:16px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="" style="font-weight:500;">Vessel Voy. No:</label>
                                                </td>
                                                <td>{!! $hbl['vesselVoyNumber'] !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style="vertical-align:top;padding:0px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td width="50%" style="padding:3px;font-weight:500">HBL No.:</td>
                                <td width="50%"
                                    style="padding:3px;border:1px solid #000;font-size:11px;font-weight:500;border-right:none;">
                                    {!! $hbl['hblNumber'] !!}
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:3px;font-weight:500">Shipment Reference No.:</td>
                                <td width="50%"
                                    style="padding:3px;border:1px solid #000;font-size:11px;font-weight:500;border-right:none;">
                                    {!! $hbl['shipmentReferenceNumber'] !!}
                                </td>
                            </tr>
                            <tr style="text-align:center;">
                                <td colspan="2" style="padding:5px;height:120px;text-align:center;position: relative;">
                                    <img src="front/img/logo.png" alt="logo"
                                        style="margin:0 auto;width:150px;margin-top:30px;position:absolute;left:28%;">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:5px;">
                                    <p>
                                        The shipment is taken in apparent good order and condition, herein at the place
                                        of
                                        receipt, and assumes the responsibility for transport and delivery by ocean
                                        vessel to
                                        the port of discharge or place of delivery, as mentioned. The contents, weight,
                                        value
                                        and measurement included are according to Shipper’s declaration. This House Bill
                                        of
                                        Lading shall have effect subject to our shipping/trading conditions. The goods
                                        to be
                                        delivered at the mentioned port of discharge or place of delivery, whichever is
                                        applicable, subject always to the exceptions, limitations, conditions and
                                        liberties
                                        set out by the Terms and Conditions of Carriage of the corresponding Master Bill
                                        of
                                        Lading, to which the Shipper and/or Consignee agree to accepting this Bill of
                                        Lading.
                                    </p>
                                    <p>
                                        In witness whereof original House Bill of Lading have been duly endorsed not
                                        otherwise
                                        stated above, one copy of which being accomplished the others shall be void.
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="border:1px solid #000;border-bottom:none;height:10px;">
        <thead>
            <tr>
                <th width="10%"
                    style="text-align:center;font-weight:normal;padding:5px;border-right:1px solid #000;border-bottom:1px solid #000;vertical-align:top;">
                    Container<br /> No.(S)</th>
                <th width="5%"
                    style="text-align:center;font-weight:normal;padding:5px;border-right:1px solid #000;border-bottom:1px solid #000;vertical-align:top;white-space:nowrap;">
                    Marks And Numbers</th>
                <th width="30%"
                    style="text-align:center;font-weight:normal;padding:5px;border-right:1px solid #000;border-bottom:1px solid #000;vertical-align:top;">
                    Number Of Packages, Kind Of Packages, <br /> General Description Of Goods</th>
                <th
                    style="text-align:center;font-weight:normal;padding:5px;border-right:1px solid #000;border-bottom:1px solid #000;vertical-align:top;">
                    Gross <br /> Weight</th>
                <th
                    style="text-align:center;font-weight:normal;padding:5px;border-bottom:1px solid #000;vertical-align:top;">
                    Measurement</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10%"
                    style="text-align:left;vertical-align:top;padding:5px;border-right:1px solid #000;height:300px;white-space:nowrap">
                    <pre>{!! $hbl['containerNo'] !!}</pre>
                </td>
                <td width="5%"
                    style="text-align:left;vertical-align:top;padding:5px;border-right:1px solid #000;height:300px;white-space:nowrap">
                    <pre>{!! $hbl['marksAndNumbers'] !!}</pre>
                </td>
                <td width="30%"
                    style="text-align:left;vertical-align:top;padding:5px;border-right:1px solid #000;height:300px;">
                    <pre>{!! $hbl['description'] !!}</pre>
                </td>
                <td style="text-align:center;vertical-align:top;padding:5px;border-right:1px solid #000;height:300px;">
                    <pre>{!! $hbl['grossWeight'] !!}</pre>
                </td>
                <td style="text-align:center;vertical-align:top;padding:5px;height:300px;">
                    <pre>{!! $hbl['measurement'] !!}</pre>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="border:1px solid #000;border-bottom:none;">
        <tbody>
            <tr style="">
                <td style="vertical-align:top;padding:5px;border-right:1px solid #000;height:42px;" width="25%">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Freight Amount</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
                                    {!! $hbl['freightAmount'] !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align:top;padding:5px;border-right:1px solid #000;height:42px;" width="25%">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Freight Payable at</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
                                    {!! $hbl['freightPayable'] !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align:top;padding:5px;border-right:1px solid #000;" width="25%">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Number of Original HBL</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
                                    {!! $hbl['numberOfOriginalHbl'] !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align:top;padding:5px;" width="25%">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Place and Date of Issue</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
                                    {!! $hbl['issueDate'] !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="border:1px solid #000;">
        <tbody>
            <tr style="">
                <td width="50%" style="vertical-align:top;border-right:1px solid #000;padding:5px;height:94px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label>Other Particulars: (If any)</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 50px;vertical-align:top;">
                                    {!! $hbl['others'] !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom:0;">
                                    Weight and measurement of container not to be included
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" style="padding:5px;height:94px;vertical-align:top;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <label>&nbsp;</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 50px;vertical-align:top;">
                                    {!! $hbl['lastPart'] !!}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: right;">
                                    Signature & Seal
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%">
        <tbody>
            <tr>
                <td style="text-align:center;font-size:11px">
                    Air Logistics Group Pvt. Ltd. GPO Box No.: 24884, Kathmandu, Nepal Phone: +977-1-4004795,
                    Email:cs@airlogisticsgroup.com.np
                </td>
            </tr>
        </tbody>
    </table>

    <span
        style="font-size:45px;text-transform:uppercase;position:absolute;display:block;bottom:15%;left:0;right:0;text-align:center;color:#c5c4c4;"><b
            style="display: block;font-weight:500;font-family: 'Roboto', sans-serif;line-height:40px;">{!! request('type') !!}</span>
            <span style="font-size:14px;position:absolute;bottom:22%;left:5%;right:0;text-align:center;color:#000;margin:auto;width:100%;">
                {!! $hbl['amountInWords']!!}
            </span> 

</body>

</html>
