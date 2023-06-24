<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Receipt</title>
    <link rel="stylesheet" href="">

    <style>
        table {
            font-family: 'Roboto', sans-serif;
            width: 100%;
            font-size: 14px;
            line-height: 1.2;
        }

        img {
            max-width: 110px;
        }

        td {
            padding: 3px;
            vertical-align: top;
        }

        th {
            text-align: left;
            font-size: 16px;
            padding-bottom: 5px;
        }

        hr {
            border-top: 1px solid #000;
            border-bottom: none;
            margin: 3px 0px;
        }

    </style>
</head>

<body>

    <table>
        <tbody>
            <tr>
                <td width="50%" style="vertical-align: middle;"><img src="{{ public_path('/img/logo.png') }}"
                        alt="logo">
                </td>
                <td width="50%"
                    style="font-size:30px;font-weight: 500;letter-spacing: 2px;vertical-align: middle;text-align: right">
                    Shipment Receipt</td>
            </tr>
        </tbody>
    </table>
    <hr>

    <table>
        <tbody>
            <tr>
                <td width="50%">
                    <table>
                        <thead>
                            <tr>
                                <th>Shipment From</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $shipment->senderName }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->senderCompany }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->senderAddress }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->senderAddress1 }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->senderCity }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->senderCountry }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->senderMobile }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->senderEmail }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%">
                    <table>
                        <thead>
                            <tr>
                                <th>Shipment To</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $shipment->receiverName }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->receiverCompany }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->receiverAddress }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->receiverAddress1 }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->receiverCity }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->receiverCountry }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->receiverMobile }}</td>
                            </tr>
                            <tr>
                                <td>{{ $shipment->receiverEmail }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>

    <table>
        <tbody>
            <tr>
                <td width="50%">
                    <table>
                        <thead>
                            <tr>
                                <th>Billing Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="50%">Payment Terms:</td>
                                <td width="50%" style="text-transform: capitalize;">{{ $shipment->payment_terms }}
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">Billing A/C.:</td>
                                <td width="50%">{{ $shipment->billing_account }}</td>
                            </tr>
                            <tr>
                                <td width="50%">Shipping Charges Approx:</td>
                                <td width="50%">NPR
                                    {{ $shipment->getCharge->billingCalculated? bcdiv($shipment->getCharge->billingCalculated, 1, 2): bcdiv($shipment->getCharge->total, 1, 2) }}
                                </td>
                            </tr>
                            @if ($shipment->getCharge->tiaCalculatedCharge)
                                <tr>
                                    <td width="50%">TIA Charges:</td>
                                    <td width="50%">{{ bcdiv($shipment->getCharge->tiaCalculatedCharge, 1, 2) }}</td>
                                </tr>
                            @endif
                            @if ($shipment->getCharge->handlingCalculated)
                                <tr>
                                    <td width="50%">Shipment Handling Charges:</td>
                                    <td width="50%">{{ bcdiv($shipment->getCharge->handlingCalculated, 1, 2) }}</td>
                                </tr>
                            @endif
                            @if ($shipment->getCharge->packaging)

                                <tr>
                                    <td width="50%">Packaging Charges:</td>
                                    <td width="50%">{{ bcdiv($shipment->getCharge->packaging, 1, 2) }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td width="50%">Total:</td>
                                <td width="50%">{{ bcdiv($shipment->getCharge->billing_total, 1, 2) }}</td>
                            </tr>
                            <tr>
                                <td width="50%">Amount in words:</td>
                                <td width="50%" style="text-transform: capitalize;text-style:bold"> NPR:
                                    {{ $format->format(bcdiv($shipment->getCharge->billing_total, 1, 2)) }}
                                    Only</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%">
                    <table>
                        <thead>
                            <tr>
                                <th>Product Details (Services)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="50%">Shipment Date:</td>
                                <td width="50%">{{ $shipment->shipment_date->format('d-M-Y') }}</td>
                            </tr>
                            <tr>
                                <td width="50%">House Airway Bill No:</td>
                                <td width="50%">{{ $shipment->barcode }}</td>
                            </tr>
                            <tr>
                                <td width="50%">Service Provider:</td>
                                <td width="50%">{{ $shipment->getServiceAgent->title }}</td>
                            </tr>
                            <tr>
                                <td width="50%">Shipment Type:</td>
                                <td width="50%">{{ $shipment->getPackageType->package_type }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>

            </tr>
        </tbody>
    </table>
    <hr>

    <table>
        <tbody>
            <tr>
                <td width="50%">
                    <table>
                        <thead>
                            <tr>
                                <th>International Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="50%">Value Declared for Customs:</td>
                                <td width="50%">{{ @$shipment->currency_type }} {{ $shipment->value }}</td>
                            </tr>
                            <tr>
                                <td width="50%">Destination Duties/Taxes:</td>
                                <td width="50%">{{ $shipment->destination_duties }}</td>
                            </tr>
                            <tr>
                                <td width="50%">Estimated Delivery Date:</td>
                                <td width="50%">Check online with tracking number</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
                <td width="50%">
                    <table>
                        <thead>
                            <tr>
                                <th>Pieces and Weight Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="50%">Number of Pieces:</td>
                                <td width="50%">{{ $shipment->totalPiece }}</td>
                            </tr>
                            <tr>
                                <td width="50%">Gross Weight</td>
                                <td width="50%">{{ $shipment->total_weight }} kg</td>
                            </tr>
                            <tr>
                                <td width="50%">Dimensional Weight:</td>
                                <td width="50%">{{ $shipment->total_volume_weight }} kg</td>
                            </tr>
                            <tr>
                                <td width="50%">Chargeable Weight:</td>
                                <td width="50%">{{ $shipment->total_chargeable_weight }} Kg</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

        </tbody>
    </table>
    <hr>

    <table>
        <tbody>
            <tr>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th>Reference Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Reference:</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>

    <table>
        <tbody>
            <tr>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th>Description Of Goods</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $shipment->content }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:20px;">
        <thead>
            <tr>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    1. The amount shown is an approximate charges only. Final billing amount will be ascertained once
                    the service provider reweighs the shipment.
                </td>
            </tr>
            <tr>
                <td>
                    2. Any fraction of weight is charge the next higher weight group (500 grams basis upto 20 Kg and 1
                    Kg basis above 20 Kgs).
                </td>
            </tr>
            <tr>
                <td>
                    3. Shipment will be reweighted and remeasured at DXB and higher of actual or volumetric weight per
                    pieces will be charged while issuing final Invoice.
                </td>
            </tr>
            <tr>
                <td>
                    4. Destination duties/taxes are not included and are to be paid by consignee.
                </td>
            </tr>
            <tr>
                <td>
                    5. Shipment may be delayed by airline handling, clearance process or other circumference beyond our
                    control.
                </td>
            </tr>
            <tr>
                <td>
                    6. Counterfeit/Copy/Branded/Liquid/DG Product/Powder items are not accepted. If found, shipment will
                    be disposed.
                </td>
            </tr>
            <tr>
                <td>
                    7. ALG will not be liable for any damages in transit / incidents due to improper packaging from
                    shipper.
                </td>
            </tr>
            <tr>
                <td>
                    8. Should the shipper fail to make payment as agreed, the shipment may be held until such settlement
                    is made.
                </td>
            </tr>
            <tr>
                <td>
                    9. Shipper can not held payment for any dispute that may arise during the course of shipment
                    movement.
                </td>
            </tr>
            <tr>
                <td>
                    10. Any return (RTO) shipment returned due to any reason would be charged to shipper at
                    actual.
                </td>
            </tr>


        </tbody>
    </table>

    <table
        style="padding:10px 0px 5px;font-family: 'Roboto', sans-serif;text-align:leftvertical-align:top;margin-top:20px;"
        width="100%">
        <thead>
            <tr>
                <th style="width:50%; text-align:left;font-size:
                14px;font-weight:500;vertical-align:top;">
                    <img src="data:image/png;base64,{{ \DNS1D::getBarcodePNG($shipment->barcode, 'C39', 1, 33) }}"
                        alt="images">
                    <b
                        style="display: block;margin-top: 5px;letter-spacing: 12px;font-size:15px;">{{ $shipment->barcode }}</b>
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
                    {{ date('Y') }} © Copyright {{ config('settings.name') }}. All Rights Reserved.
                </td>
            </tr>
        </thead>
    </table>


</body>

</html>
