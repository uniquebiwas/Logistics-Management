<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    @foreach ($package->getItems as $key => $item)
        <table style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;border-bottom:1px solid #000;"
            width="100%">
            <thead>
                <tr>
                    <th style="width:50%;">
                        <table>
                            <thead>
                                <tr>
                                    <th style="padding:5px 10px;">
                                        <img src="img/logo.png" alt="logo" style="max-width:180px;">
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </th>
                    <th style="padding:5px 10px;width:50%; text-align:right;font-size:
            16px;font-weight:500;">
                        <img src="data:image/png;base64,{{ \DNS1D::getBarcodePNG($package->barcode, 'c39', 1, 35) }}"
                            alt="images" width="100%" style="max-width:200px;">
                        <b style="display: block;margin-top: 5px;letter-spacing: 1px;font-size:16px;">{{ $package->barcode }}</b>
                        <b style="display: block;margin-top: 15px;font-weight: normal;">{{ now()->format('d-M-Y H:i:a') }} </b><br>
                    </th>
                </tr>
            </thead>
        </table>
        <table
            style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;border-bottom:1px solid #000;font-size:14px;"
            width="100%">
            <tbody>
                <tr>
                    <td width="50%" style="vertical-align: top;">
                        <table>
                            <thead>
                                <tr>
                                    <td width="80px" style="vertical-align: top;">
                                        <b>Shipper:</b>
                                    </td>
                                    <td width="90%" style="vertical-align: top;">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        {{ $package->senderName }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        {{ $package->senderAddress }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $package->senderCity }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $package->senderState }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $package->senderCountry }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </td>
                    <td width="50%" style="vertical-align: top;">
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Contact Person:</b></td>
                                    <td> {{ $package->senderAttention }}</td>
                                </tr>
                                <tr>
                                    <td><b>Contact Number:</b></td>
                                    <td> {{ $package->senderMobile }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table
            style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;border-bottom:1px solid #000;font-size:14px;"
            width="100%">
            <tbody>
                <tr>
                    <td width="50%" style="vertical-align: top;">
                        <table>
                            <thead>
                                <tr>
                                    <td width="80px" style="vertical-align: top;">
                                        <b>Consignee:</b>
                                    </td>
                                    <td width="90%" style="vertical-align: top;">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        {{ $package->receiverCompany }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $package->receiverAttention }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $package->receiverAddress }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $package->receiverCity }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $package->receiverState }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ $package->receiverCountry }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </td>
                    <td width="50%" style="vertical-align: top; " >
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Contact Person:</b></td>
                                    <td>{{ $package->receiverAttention }}</td>
                                </tr>
                                <tr>
                                    <td><b>Contact Number:</b></td>
                                    <td> {{ $package->receieverMobile ?? $package->receiverTelephone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table
            style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;border-bottom:1px solid #000;font-size:14px;"
            width="100%">
            <thead>
                <tr>
                    <td width="50%" style="vertical-align: top;">
                        Reference Number: {{ $package->reference_number }}
                    </td>
                    <td style="vertical-align: top;">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        Pce/Gross Weight
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b
                                            style="display: block;text-align:center;">{{ $item->piece_number }}/{{ $package->total_weight }}Kg</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="vertical-align: top;">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        Piece
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b style="display: block;text-align:center;">
                                            {{ $item->piece_number }}/{{ $package->totalPiece }}</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </thead>
        </table>
        <table
            style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;border-bottom:1px solid #000;font-size:14px;margin-bottom:10px;"
            width="100%">
            <thead>
                <tr>
                    <td>
                        <b>Description of Goods:</b>{{ $package->content }}
                    </td>
                </tr>
            </thead>
        </table>
        <table style="padding:10px 0px;font-family: 'Roboto', sans-serif;text-align:left;font-size:14px;margin-bottom:10px;" width="100%">
            <thead>
                <tr>
                    <th style="width:50%; text-align:left;font-size:
            14px;font-weight:500;">
                        <img src="data:image/png;base64,{{ \DNS1D::getBarcodePNG($package->barcode, 'c39', 1, 35) }}"
                            alt="images" width="100%" style="max-width:200px;">
                        <b
                            style="display: block;margin-top: 5px;letter-spacing: 1px;font-size:16px;">{{ $package->barcode }}</b>
                    </th>
                </tr>
            </thead>
        </table>
    @endforeach
</body>

</html>
