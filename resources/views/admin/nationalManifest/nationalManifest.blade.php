<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Manifest</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>

                    <table style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;font-size:14px;"
                        width="100%">
                        <thead>
                            <tr>
                                <td style="line-height:20px;">
                                    <b style="text-transform: uppercase"><u>Consignee :</u></b> <br />
                                    <b> Name:</b> {{ $nationalManifest->client }} <br />
                                    <b> Address:</b> {{ $nationalManifest->clientLocation }}<br />
                                    <b>Phone:</b> {{ $nationalManifest->phone }}
                                </td>
                                <td style="padding:5px 10px;width:50%; text-align:center;font-size:
                    16px;font-weight:normal;">
                                    <img src="img/logo.png" alt="images" style="max-width:180px;">
                                </td>
                                <td style="text-align: right;">
                                    <table style="margin-left: auto;text-align:right;">
                                        <tbody>
                                            <tr>

                                                <td style="font-weight:bold;">{{ config('settings.name') }}</td>
                                            </tr>
                                            <tr>

                                                <td>{{ config('settings.address') }}</td>
                                            </tr>
                                            <tr>

                                                <td>PAN: {{ config('settings.pan') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <table
                        style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;font-size:14px;margin-bottom:10px;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td width="33.33333%">

                                </td>
                                <td style="text-align: center;" width="33.33333%">
                                    <b
                                        style="text-align: center; display: block;text-transform:uppercase;font-size:20px;m">Manifest</b>
                                </td>
                                <td width="33.33333%">
                                    <table style="margin-left: auto;text-align:right;">
                                        <tbody>
                                            <tr>
                                                <td><b>Manifest No:</b></td>
                                                <td>{{ $nationalManifest->manifestNumber }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Date:</b></td>
                                                <td>{{ $nationalManifest->created_at->format('d-M-Y') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table
                        style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;font-size:14px;border-collapse:collapse;width:100%;">
                        <thead>
                            <tr>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    SN</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    HAWB No</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Shipper</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Consignee</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Pieces</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Weight</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Contents</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Destination</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Remarks</th>
                            </tr>

                        </thead>
                        <tbody>
                            @php
                                $totalPieces = 0;
                                $totalWeight = 0;
                                $index = 1;
                            @endphp

                            @foreach ($nationalManifest->shipment as $key => $item)
                                <tr>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $key + 1 }}</td>
                                    <td style="padding:5px 10px;border:1px solid #000;text-align:center;">
                                        {{ $item->barcode }}
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
                                        {{ $item->pivot->remarks }}
                                    </td>
                                </tr>

                                @php
                                    $totalPieces += $item->totalPiece;
                                    $totalWeight += $item->total_weight;
                                @endphp


                            @endforeach
                            <tr>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;"></td>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;"></td>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;"></td>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;font-weight:bold;">
                                    Total</td>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;font-weight:bold;">
                                    {{ $totalPieces }}
                                </td>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;font-weight:bold;">
                                    {{ $totalWeight }} KGS</td>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;"></td>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;"></td>
                                <td style="padding:5px 10px;border:1px solid #000;text-align:center;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table
                        style="font-family: 'Roboto', sans-serif;text-align:left;font-size:14px;border-collapse:collapse;width:100%;margin-top:10px;margin-bottom:20px;">
                        <tbody>
                            <tr>
                                <td style="text-transform: uppercase;">
                                    Custom Value {{ $nationalManifest->currencyType }}
                                    {{ $nationalManifest->total }}
                                </td>

                            </tr>
                            <tr>
                                <td style="text-transform: uppercase;padding-bottom:15px;">
                                    amount in words: {{ $nationalManifest->currencyType }}
                                    {{ $format->format($nationalManifest->total) }} Only
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:16px;font-weight:bold;border-top:1px solid #000;padding-top:10px;">
                                    Value declared for customs purpose only .
                                </td>
                            </tr>
                        </tbody>
                    </table>

</body>

</html>
