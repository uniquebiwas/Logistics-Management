<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Manifest</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>

                    <table
                        style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;border-bottom:1px solid #000;font-size:14px;"
                        width="100%">
                        <thead>
                            <tr>
                                <th style="width:50%;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="padding:5px 10px;">
                                                    <img src="{{ public_path('/img/logo.png') }}" alt="logo" style="max-width:180px;">
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </th>
                                {{-- <th >Manifest</th> --}}
                                <th style="padding:5px 10px;width:50%; text-align:right;font-size:
                    16px;font-weight:normal;line-height:26px;">
                                    <b
                                        style="font-size:22px;text-transform:uppercase;">{{ config('settings.name') }}</b><br>
                                    {{ config('settings.address') }}
                                    <br>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <table width="100%"
                        style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;font-size:14px;border-collapse:collapse;margin-top:20px;">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="border-collapse:collapse;">
                                        <tbody>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Date:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">
                                                    {{ $manifest->created_at->format('d-M-y') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Origin:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;text-transform:capitalize">{{ $manifest->origin }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Shipper:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">{{ config('settings.name') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Airline/Flight No:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">{{ $manifest->flightNumber }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Flight Date:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">{{ $manifest->date->format('d-M-y') }}</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table style="border-collapse:collapse;margin-left:auto;">
                                        <tbody>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Mawb No:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">{{ $manifest->masterAirwayBill }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Destination:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">{{ $manifest->destination }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Consignee:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">{{ $manifest->client }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Consignee Address:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">{{ $manifest->clientLocation }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px 10px;border:1px solid #000;"><b>Manifest No:</b></td>
                                                <td style="padding:5px 10px;border:1px solid #000;">{{ $manifest->manifest_number }}</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" style="font-family: 'Roboto', sans-serif;text-align:center;font-size:13px;border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;font-size:20px;text-transform:uppercase;font-weight:bold;">Manifest</td>
                            </tr>
                        </tbody>
                    </table>
                    <table
                        style="padding:10px 0px 0;font-family: 'Roboto', sans-serif;text-align:left;font-size:13px;border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th width="20px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    S.N</th>
                                <th width="40px;"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    HAWB No</th>
                                <th width="70px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    Service</th>
                                <th width="120px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    Shipper</th>
                                <th width="120px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    Consignee</th>
                                <th width="20px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    Pcs</th>
                                <th width="30px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    Weight</th>
                                <th width="180px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    Contents</th>
                                <th width="80px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    Destination</th>
                                <th width="60px"
                                    style="text-transform:capitalize;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;text-align:center;">
                                    Value</th>
                            </tr>

                        </thead>
                        <tbody>
                            @php
                                $sum = 0;
                                $index = 1;
                            @endphp


                            @foreach ($manifest->shipment as $key => $item)
                                <tr>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $key + 1 }}</td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->barcode }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ optional($item->getServiceAgent)->title }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->senderName }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->receiverCompany }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->totalPiece }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->total_weight }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->content }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->receiverCountry }}</td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->currency_type }} {{ $item->value }}
                                    </td>
                                </tr>
                                @php
                                    $sum += $item->value;
                                @endphp


                            @endforeach

                        </tbody>
                    </table>


</body>

</html>
