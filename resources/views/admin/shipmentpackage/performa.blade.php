<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Receipt</title>
</head>

<body style="margin:0;padding:0;font-size:14px;">

    <table width="100%"
        style="max-width:800px;margin:auto;padding-left:20px;padding-right:20px;box-shadow: 0px 0px 7px rgb(0 0 0 / 20%);background:#fff;border-radius:4px;margin-bottom:20px;">
        <caption
            style="font-family: Arial, sans-serif;padding-bottom:20px;font-weight:bold;font-size:18px;margin-left: 20px;margin-right: 20px;margin-top: 20px;">
            Airlogistic Invoice</caption>
        <tbody>
            <tr>
                <td style="padding:0;vertical-align:top;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:10px 0;width:100px;">
                                    Awb no.:</td>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:10px 0;">{{ $performa->awb_number }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" style="border-collapse: collapse;border:1px solid #b1b1b1;">
                        <thead>
                            <tr>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1; padding:3px;background: #DFDFDF;">
                                    Consignor(From)</th>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1;padding:3px;background: #DFDFDF;">
                                    Consignor(To)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:0;vertical-align:top;">
                                    <table width="100%"
                                        style="border-collapse: collapse;border-right:1px solid #b1b1b1;">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    Consignor:</td>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    {{ $performa->getSender->name }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    Address:</td>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    {{ $performa->getSender->address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    Phone:</td>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    {{ $performa->getSender->mobile }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    Fax:</td>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    {{ $performa->getSender->fax }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="padding:0;vertical-align:top;">
                                    <table width="100%" style="border-collapse: collapse;">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    Consigee:</td>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    {{ $performa->getReceiver->name }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    Address:</td>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    {{ $performa->getReceiver->address }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    Phone:</td>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    {{ $performa->getReceiver->mobile }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    Fax:</td>
                                                <td
                                                    style="font-family: Arial, sans-serif;padding:5px 5px;vertical-align:top;">
                                                    {{ $performa->getReceiver->fax }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" style="border-collapse: collapse;">
                        <caption
                            style="text-align:left;font-weight:bold;padding-top:20px;font-family: Arial, sans-serif;padding-bottom:5px;">
                            Item Details</caption>
                        <thead>
                            <tr>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1; padding:3px;background: #DFDFDF;text-align:left;">
                                    Track#
                                </th>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1; padding:3px;background: #DFDFDF;text-align:left;">
                                    Mfg. Country
                                </th>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1; padding:3px;background: #DFDFDF;text-align:left;">
                                    Description
                                </th>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1; padding:3px;background: #DFDFDF;text-align:left;">
                                    Unit Value
                                </th>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1; padding:3px;background: #DFDFDF;text-align:left;">
                                    Sub Total
                                </th>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1; padding:3px;background: #DFDFDF;text-align:left;">
                                    Custom Code
                                </th>
                                <th
                                    style="font-family: Arial, sans-serif;font-weight:bold;border:1px solid #b1b1b1; padding:3px;background: #DFDFDF;text-align:left;">
                                    Export Reason
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($performa->getItems as $key => $item)
                                <tr>
                                    <td style="padding:10px;border:1px solid #b1b1b1;font-family: Arial, sans-serif;">
                                        {{ $performa->tracking_code }}
                                    </td>
                                    <td style="padding:10px;border:1px solid #b1b1b1;font-family: Arial, sans-serif;">
                                        {{ $item->piece_number }}
                                    </td>
                                    <td style="padding:10px;border:1px solid #b1b1b1;font-family: Arial, sans-serif;">
                                    {{ $item->description }}
                                    </td>
                                    <td style="padding:10px;border:1px solid #b1b1b1;font-family: Arial, sans-serif;">
                                    </td>
                                    <td style="padding:10px;border:1px solid #b1b1b1;font-family: Arial, sans-serif;">
                                    </td>
                                    <td style="padding:10px;border:1px solid #b1b1b1;font-family: Arial, sans-serif;">
                                    </td>
                                    <td style="padding:10px;border:1px solid #b1b1b1;font-family: Arial, sans-serif;">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table width="100%" style="padding-top:15px;">
                        <tbody>
                            <tr>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:5px 0;width:120px;">
                                    Total Pieces:</td>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:5px 0;">
{{ $performa->getItems->count() }}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:5px 0;width:120px;">
                                    Total Value:</td>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:5px 0;">
                                    {{ $performa->value }} {{ $charge::CURRENCYTYPE[$performa->getCharge->currency_type] }}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:5px 0;width:120px;">
                                    Total Weight:</td>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:5px 0;">{{ $performa->total_weight }}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:5px 0;width:120px;">
                                    Contents:</td>
                                <td style="font-family: Arial, sans-serif;font-weight:bold;padding:5px 0;">
                                {{ $performa->content }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="font-family: Arial, sans-serif;line-height:22px;">
                    {{$performa->remarks}}
                    </p>
                    <p
                        style="border-bottom:1px solid #b1b1b1;font-family: Arial, sans-serif;padding-bottom:10px;margin-top:25px;">
                        Signed By:
                    </p>
                    <p style="font-family: Arial, sans-serif;font-size:13px;">Print Date: {{ now()->format('d F Y H:i:s') }}  </p>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
