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
    <table
        style="padding:10px 20px;font-family: 'Roboto', sans-serif;text-align:left;font-size:16px;border-collapse:collapse;width:100%;">
        <tbody>
            <tr>
                <td>
                    <table style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;font-size:16px;"
                        width="100%">
                        <thead>
                            <tr>
                                <th style="padding:5px 10px;width:50%; text-align:center;font-size:
                    16px;font-weight:normal;line-height:26px;">
                                    <img src="img/logo.png" alt="images" style="max-width:180px;margin-bottom:5px;"><br>
                                    Kupondole, Kathmandu, Nepal<br>
                                    Pan No: 123456789
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <table
                        style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;font-size:16px;line-height:22px;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    {{ $data->client }} <br>
                                    {{ $data->clientLocation }}
                                </td>
                                <td style="text-align: right;">
                                    <table style="margin-left: auto;">
                                        <tbody>
                                            <tr>
                                                <td><b>Manifest No:</b></td>
                                                <td>{{ $data->manifest_number }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Date:</b></td>
                                                <td>{{ $data->created_at->format('d-M-Y') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <b style="text-align: center;
                    display: block;
                    margin-top: -30px;
                    margin-bottom: 10px;">Manifest</b>
                    <table
                        style="padding:10px 20px;font-family: 'Roboto', sans-serif;text-align:left;font-size:16px;border-collapse:collapse;width:100%;">
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
                                    Box No</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Shipper</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Consignee</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Pcs(Box)</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Wt(Kgs)</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Contents</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Destination</th>
                                <th
                                    style="text-transform:uppercase;padding:5px 10px;border:1px solid #000;background: #6b0b0c;color: #fff;">
                                    Value</th>
                            </tr>
                            <tr>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                                <th style="padding:5px 10px;border:1px solid #000;font-weight:normal;">
                                    Bag:1</th>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                                <th style="padding:5px 10px;border:1px solid #000;">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sum = 0;
                            @endphp
                            @foreach ($data->shipmentPackages as $key => $package)
                                <tr>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $key + 1 }}</td>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $package->awb_number }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;"></td>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $package->senderName }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $package->receiverName }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $package->totalPiece }}</td>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $package->total_weight }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $package->content }}</td>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $package->receiverAddress }}
                                    </td>
                                    <td style="padding:5px 10px;border:1px solid #000;">{{ $package->value }}</td>
                                </tr>
                                @php
                                    $sum += $package->value;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <table
                        style="padding:10px 20px;font-family: 'Roboto', sans-serif;text-align:left;font-size:16px;border-collapse:collapse;width:100%;margin-top:20px;margin-bottom:20px;">
                        <tbody>
                            <tr>
                                <td style="text-transform: uppercase;">
                                    It's Value Rs {{ $format->format($sum) }}
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
