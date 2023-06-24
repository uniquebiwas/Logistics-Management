<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <table style="padding:0px 0px 10px;font-family: 'Roboto', sans-serif;text-align:left;" width="100%">
        <thead>
            <tr>
                <th style="width:50%;">
                    <table>
                        <thead>
                            <tr>
                                <th style="padding:5px; 10px">
                                    <img src="img/logo.png" alt="logo" style="max-width:160px;margin-right:10px;">
                                </th>
                            </tr>
                        </thead>
                    </table>
                </th>
                <th style="padding:5px 10px;width:50%; text-align:right;font-size:
                14px;font-weight:500;">
                    <b style="font-size: 30px;margin-bottom:3px;display:block;">House Airway Bill</b> <br>
                    <img src="data:image/png;base64,{{ \DNS1D::getBarcodePNG($package->barcode, 'C39', 1, 35) }}"
                        alt="images">
                    <span
                        style="display: block;letter-spacing: 10px;font-size:25px;text-align:right;margin-right:-15px;">{{ $package->barcode }}</span>
                </th>
            </tr>
        </thead>
    </table>
    <table
        style="padding:0px 0px 5px;font-family: 'Roboto', sans-serif;font-size:14px;text-align:left;border-collapse:collapse;"
        width="100%">
        <thead>
            <tr>
                <th style="font-family: 'Roboto', sans-serif;text-align: left;padding:5px 10px;font-weight:500;font-size:14px;border:1px solid #000;background: #6b0b0c;
                color: #fff;font-size:16px;">From (Shipper)</th>
                <th style="font-family: 'Roboto', sans-serif;text-align: left;padding:5px 10px;font-weight:500;font-size:14px;border:1px solid #000;background: #6b0b0c;
                color: #fff;font-size:16px;">To (Consignee)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top;width: 50%;border:1px solid #000;padding: 10px;">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>

                            <tr>
                                <td style="padding:3px 10px;width:32%;">Shipper Name:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderName }}</td>
                            </tr>

                            <tr>
                                <td style="padding:3px 10px;width:32%;">Address:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderAddress }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Address:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderAddress2 }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Address:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderAddress3 }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">City:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderCity }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">State:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderState }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">ZipCode:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderZipCode }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Country:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderCountry }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Tel No:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderTelephone }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Mobile No:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderMobile }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Email Address:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderEmail }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Attention:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->senderAttention }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align: top;width: 50%;border:1px solid #000;padding: 10px;">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Consignee Name:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverCompany }}</td>
                            </tr>

                            <tr>
                                <td style="padding:3px 10px;width:38%;">Address:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverAddress }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Address:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverAddress2 }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Address:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverAddress3 }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">City:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverCity }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">State:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverState }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">ZipCode:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverZipCode }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Country:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverCountry }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Tel No:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverTelephone }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Mobile No:</td>
                                <td style="padding:3px 10px;width:62%;;">{{ $package->receiverMobile }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Email Address:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverEmail }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Attention:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->receiverAttention }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table
        style="padding:0px 0px 5px;font-family: 'Roboto', sans-serif;font-size:14px;text-align:left;border-collapse:collapse;"
        width="100%">
        <thead>
            <tr>
                <th style="text-align: left;padding:5px 10px;font-weight:500;font-size:14px;border:1px solid #000;border-top:none;background: #6b0b0c;
                color: #fff;font-size:16px;">Billing Information</th>
                <th style="text-align: left;padding:5px 10px;font-weight:500;font-size:14px;border:1px solid #000;border-top:none;background: #6b0b0c;
                color: #fff;font-size:16px;">Product Details (Services)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top;width: 50%;border:1px solid #000;border-top:none;padding:10px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Agent Ref.:</td>
                                <td style="padding:3px 10px;width:68%;">
                                    {{ $package->getAgent->agent_profile->company_name }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Billing A/C.:</td>
                                <td style="padding:3px 10px;width:68%;">{{ $package->billing_account }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Payment Terms.:</td>
                                <td style="padding:3px 10px;width:68%;text-transform: capitalize;">
                                    {{ @$package->payment_terms }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:32%;">Shipment Reference:</td>
                                <td style="padding:3px 10px;width:68%;text-transform: capitalize;">
                                    {{ @$package->shipmentReference }}</td>
                            </tr>


                        </tbody>
                    </table>
                </td>
                <td style="vertical-align: top;width: 50%;border:1px solid #000;border-top:none;padding:10px;">
                    <table width="100%">
                        <tbody>

                            <tr>
                                <td style="padding:3px 10px;width:38%;">Shipment Type:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->getPackageType->package_type }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Service Provider:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->getServiceAgent->title }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;width:38%;">Type Of Export:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->export_type }}
                                </td>
                            </tr>

                            <tr>
                                <td style="padding:3px 10px;width:38%;">Destination Duties/Taxes:</td>
                                <td style="padding:3px 10px;width:62%;">{{ $package->destination_duties }}</td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
    </table>
    <table style="font-family: 'Roboto', sans-serif;font-size:14px;text-align:left;border-collapse:collapse;"
        width="100%">
        <thead>
            <tr>
                <th style="text-align: left;padding:5px 10px;font-weight:500;font-size:16px;border:1px solid #000;border-top:none;background: #6b0b0c;
                color: #fff;">Description Of Goods</th>
                <th style="text-align: left;padding:5px 10px;font-weight:500;font-size:16px;border:1px solid #000;border-top:none;background: #6b0b0c;
                color: #fff;">Pieces, Weight & Dimension</th>


            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top;width: 50%;border:1px solid #000;padding:0;">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td style="vertical-align: top;width: 50%;padding:10px;">
                                    {{ $package->content }}

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <table width="100%" style="border-collapse:collapse;vertical-align:bottom;">
                        <tbody>
                            <tr>
                                <td
                                    style="vertical-align: top;width: 50%;border:1px solid #000;border-left:none;padding:3px 7px;">
                                    Value Declare for Customs:
                                </td>
                                <td style="border:1px solid #000;border-right:none;padding:3px 7px;">
                                    {{ $package->currency_type . ' ' . $package->value }}
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
                </td>
                <td style="vertical-align: top;width: 50%;border:1px solid #000;">
                    <table width="100%" style="border-collapse:collapse;font-family: 'Roboto', sans-serif;">
                        <tbody>
                            <tr>
                                <td style="padding:5px;">
                                    <table width="100%" style="border-collapse:collapse;">
                                        <thead>
                                            <tr>
                                                <th
                                                    style="text-align: left;padding:7px;font-size:10px;border:1px solid #000;text-align:center;">
                                                    No. of pcs</th>
                                                <th
                                                    style="text-align: left;padding:3px 7px;font-size:10px;border:1px solid #000;text-align:center;">
                                                    Weight(KGS)</th>
                                                <th
                                                    style="text-align: left;padding:3px 7px;font-size:10px;border:1px solid #000;text-align:center;">
                                                    Length</th>
                                                <th
                                                    style="text-align: left;padding:3px 7px;font-size:10px;border:1px solid #000;text-align:center;">
                                                    Breadth</th>
                                                <th
                                                    style="text-align: left;padding:3px 7px;font-size:10px;border:1px solid #000;text-align:center;">
                                                    Height</th>
                                                <th
                                                    style="text-align: left;padding:3px 7px;font-size:10px;border:1px solid #000;text-align:center;">
                                                    V. Weight</th>
                                                <th
                                                    style="text-align: left;padding:3px 7px;font-size:10px;border:1px solid #000;text-align:center;">
                                                    C. Weight</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($package->getItems as $key => $item)
                                                <tr>
                                                    <td
                                                        style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                        {{ $item->piece_number }}</td>
                                                    <td
                                                        style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                        {{ bcdiv($item->weight, 1, 3) }}</td>
                                                    <td
                                                        style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                        {{ $item->length }}</td>
                                                    <td
                                                        style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                        {{ $item->width }}</td>
                                                    <td
                                                        style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                        {{ $item->height }}</td>
                                                    <td
                                                        style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                        {{ bcdiv($item->volume_weight, 1, 3) }}</td>
                                                    <td
                                                        style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                        {{ bcdiv($item->volume_weight > $item->weight ? $item->volume_weight : $item->weight, 1, 3) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                {{-- <th
                                                style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                Total No. Of Pcs</th> --}}
                                                <th
                                                    style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;font-size:12px;background:#d9d9d9;">
                                                    {{ $package->totalPiece }}</th>
                                                {{-- <th
                                                    style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;">
                                                    Gross Weight</th> --}}

                                                <th
                                                    style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;font-size:12px;background:#d9d9d9;">
                                                    {{ bcdiv($package->total_weight, 1, 3) }} Kgs</th>
                                                <th
                                                    style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;font-size:12px;background:#d9d9d9;">
                                                </th>
                                                <th
                                                    style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;font-size:12px;background:#d9d9d9;">
                                                </th>
                                                <th
                                                    style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;font-size:12px;background:#d9d9d9;">
                                                    D Weight</th>
                                                <th
                                                    style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;font-size:12px;background:#d9d9d9;">
                                                    {{ bcdiv($package->total_volume_weight, 1, 3) }} Kgs</th>
                                                <th
                                                    style="padding:3px 7px;line-height: 10px; font-size:10px;border:1px solid #000;text-align:center;font-size:12px;background:#d9d9d9;">
                                                    {{ $package->total_chargeable_weight }}
                                                </th>

                                            </tr>

                                        </tfoot>

                                    </table>

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table width="100%"
        style="border-collapse:collapse;border-top:none;font-family: 'Roboto', sans-serif;font-size:14px;">
        <tbody>
            <tr>
                <td style="padding:0;border:1px solid #000;border-top:none;" width="50%">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td style="vertical-align: top;padding:3px 7px;">
                                    Value Declare for Customs:
                                </td>
                                <td
                                    style="border:1px solid #000;padding:3px 7px;text-align:right;border-top:none;border-left:none;border-bottom:none;font-weight:bold;">
                                    {{ $package->currency_type . ' ' . $package->value }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="padding:0;border:1px solid #000;border-top:none;" width="50%">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td style="vertical-align: top;padding:3px 7px;font-weight:bold;" colspan="2">
                                    Chargeable Weight:
                                </td>
                                <td style="vertical-align: top;padding:3px 7px;font-weight:bold;text-align:right;">
                                    {{ $package->total_chargeable_weight }} Kgs
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="padding:5px 0px 5px;font-family: 'Roboto', sans-serif;font-size:14px;text-align:left;border-collapse:collapse;font-size:14px;"
        width="100%">
        <thead>
            <tr>
                <th style="text-align: left;padding:5px 10px;font-weight:500;font-size:16px;border:1px solid #000;border-top:none;background: #6b0b0c;
                color: #fff;">Prepared By</th>
                <th style="text-align: left;padding:5px 10px;font-weight:500;font-size:16px;border:1px solid #000;border-top:none;background: #6b0b0c;
                color: #fff;">Signature</th>
                <th style="text-align: left;padding:5px 10px;font-weight:500;font-size:16px;border:1px solid #000;border-top:none;background: #6b0b0c;
                 color: #fff;">Date</th>
                <th style="text-align: left;padding:5px 10px;font-weight:500;font-size:16px;border:1px solid #000;border-top:none;background: #6b0b0c;
                  color: #fff;">Time</th>

            </tr>

        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top;border:1px solid #000;width:25%;">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr>

                                <td style="padding:5px 10px;">
                                    {{ optional($package->creator)->agent_profile->company_name ?? 'Air Logistics Group' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align: top;border:1px solid #000;width:25%;">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr>

                                <td style="padding:5px 10px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align: top;border:1px solid #000;width:25%;">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr>

                                <td style="padding:5px 10px;"> {{ $package->created_at->format('d-M-Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="vertical-align: top;border:1px solid #000;width:25%;">
                    <table width="100%" style="border-collapse:collapse;">
                        <tbody>
                            <tr>

                                <td style="padding:5px 10px 0;"> {{ $package->created_at->format('h:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="padding:0px 0px 5px;font-family: 'Roboto', sans-serif;font-size:14px;text-align:left;padding-top:5px;"
        width="100%">
        <tbody>
            <tr>
                <td style="line-height: 18px;padding:8px 0px;text-align:justify;font-size:14px;">
                    <b>Air Logistics Group’s liability is limited:</b> By tendering this shipment to Air Logistics
                    Group, the shipper agrees to Air Logistics Group’s liability for loss, damage or delay of this
                    shipment will not exceed US$ 50.00. This shipment may also be subject to the rules relating to
                    liability established by the Warsaw Convention, Montreal Convention or other international treaties
                    and provisions. Under no circumstance shall Air Logistics Group be liable for special consequential
                    indirect or incidental damages or losses. Therefore Air Logistics Group recommends the shipper to
                    purchase insurance for each shipment.
                </td>
            </tr>
        </tbody>
    </table>
    <table style="padding:10px 0px 5px;font-family: 'Roboto', sans-serif;text-align:leftvertical-align:top;"
        width="100%">
        <thead>
            <tr>
                <th style="width:50%; text-align:left;font-size:
                14px;font-weight:500;vertical-align:top;">
                    <img src="data:image/png;base64,{{ \DNS1D::getBarcodePNG($package->barcode, 'C39', 1, 35) }}"
                        alt="images">
                    <b
                        style="display: block;margin-top: 5px;letter-spacing: 16px;font-size:15px;">{{ $package->barcode }}</b>
                    <span>www.algxpress.com</span>
                </th>
                <th style="vertical-align:top;text-align:right;">
                    Kathmandu, Nepal <br>Tel: @foreach (config('settings.phone') as $phone)
                        {{ $phone['phone_number'] }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </th>
            </tr>
        </thead>
    </table>
    <table style="padding:0px 0px 5px;font-family: 'Roboto', sans-serif;text-align:center;" width="100%">
        <thead>
            <tr>
                <td>
                    <b>Electronically Generated HAWB</b>
                </td>
            </tr>
        </thead>
    </table>
</body>

</html>
