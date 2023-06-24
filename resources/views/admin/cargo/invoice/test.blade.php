<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PDF File</title>
    <link rel="stylesheet" href="">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;

        }

        * {
            font-family: 'Montserrat', sans-serif !important;
        }

        b {
            font-weight: 500;
        }
        #datatable th{
            margin: 0;
            padding: 0;
            font-size: 13px;
        }

        #datatable td{

            font-size: 13px;
        }

        @page {
            /* size: 210mm 297mm; */
            margin: 13mm 10mm 13mm 10mm;

        }

    </style>
</head>

<body>
    <table
        style="font-family: 'Montserrat', sans-serif;font-size: 14px;border-collapse: collapse;margin:auto;width:100%;background:#fff;border-bottom:2px solid #000;padding-bottom:5px;">
        <tbody>
            <tr>
                <td width="100px" style="vertical-align:bottom;"><img src="img/logo.png" alt="images"
                        style="max-width: 160px;vertical-align:middle;padding:5px 5px 20px;"></td>
                <td width="255px" style="text-align: center;vertical-align:middle;padding:5px;">
                    <span
                        style="text-align: center;display: block;margin-left:-30px;font-size:32px;">{{ config('settings.name') }}</span>
                    <span
                        style="text-align: center;display: block;margin-left:-30px;">{{ config('settings.address') }}</span>
                    <span
                        style="text-align: center;display: block;margin-left:-30px;">finance@airlogisticsgroup.com.np</span>
                    <span
                        style="text-align: center;display: block;margin-left:-30px;">{{ config('settings.phone')[0]['phone_number'] }}</span>
                    <span style="text-align: center;display: block;margin-bottom: 10px;margin-left:-30px;">Pan No:
                        {{ config('settings.pan') }}</span>
                </td>
                <td width="120px" style="vertical-align:bottom;padding:5px 0px;">
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="text-align: right;"> <b
                                        style="color: #6b0b0c;font-size: 40px;font-weight: 600;letter-spacing: .5px;text-transform: uppercase;vertical-align: bottom;text-align:right;">Invoice</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="font-family: 'Montserrat', sans-serif;font-size:14px;;width:100%;margin-bottom:5px;">
        <tbody>
            <tr>
                <td width="70%">
                    <table>
                        <tbody>

                            <tr>
                                <td style="vertical-align:top"><b>Customer A/C Name:</b></td>
                                <td style="vertical-align:top">{{ @$invoice->customerName }}

                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top"><b>Address:</b></td>
                                <td style="vertical-align:top">
                                    <span style="text-transform: capitalize">{{ $invoice->address }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Telephone No:</b></td>
                                <td>{{ @$invoice->telephone }}</td>
                            </tr>
                            <tr>
                                <td><b>Customer Pan No:</b></td>
                                <td>{{ $invoice->customerVatNumber }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="30%">
                    <table style="margin-right: 0; margin-left: auto;">
                        <tbody>
                            <tr>
                                <td><b>Invoice No:</b></td>
                                <td><b>{{ $invoice->invoiceNumber }}</b></td>
                            </tr>
                            @if ($invoice->parentInvoice)
                                <tr>
                                    <td><b>Ref. Inv No:</b></td>
                                    <td>{{ $invoice->parentInvoice->invoiceNumber }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>Date:</b></td>
                                <td>
                                    {{ $invoice->date->format('d-M-Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Miti:</b></td>
                                <td>{{ datenep($invoice->date) }}</td>
                            </tr>
                            <tr>
                                <td><b>Payment Terms:</b></td>
                                <td style=" text-transform: capitalize;">{{ $invoice->paymentType }}</td>
                            </tr>
                            @if ($invoice->dueDate)
                                <tr>
                                    <td><b>Due Date:</b></td>
                                    <td>{{ optional($invoice->dueDate)->format('d-M-Y') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="font-family: 'Montserrat', sans-serif;font-size: 14px;border-collapse: collapse;margin-top:15px;"
        width="100%">
        <tr>
            <th style="text-align:center;font-weight:normal;padding:15px;font-size: 16px;padding-top:35px;">We have
                debited your account
                for the following services</th>
        </tr>
    </table>
    <table style="font-family: 'Roboto', sans-serif;font-size: 14px;border-collapse: collapse;width:100%;max-width:100%;" id="datatable">

        <thead>
            <tr>
                <th
                    style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    SN</th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Particular
                </th>
                <th
                    style="pxpadding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Service
                </th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    <small style="font-size: 8pt;">AWB/MBL/HBL</small><br> No</th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    <small style="font-size: 8pt;">AWB/MBL/HBL</small><br> Date</th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Consignee</th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Destination
                </th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;">
                    PCS
                </th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Weight<br>(KGS)</th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Rate</th>
                <th style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    Amount</th>

            </tr>
        </thead>
        <tbody>
            @php
                $total = bcdiv($invoice->awbs->sum('amount'), 1, 2);
            @endphp
            @foreach ($invoice->awbs as $key => $awb)
                <tr>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;width:5%">
                        {{ $key + 1 }}</td>
                    <td
                        style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;text-transform:capitalize">
                        {{ $awb->particulars }}

                    </td>
                    <td
                        style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;text-transform:capitalize">
                        {{ $invoice->getServices($awb->service) }}
                    </td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        {{ $awb->awbNumber }}
                    </td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        {{ $awb->awbDate }}
                    </td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        {{ $awb->consignee }}
                    </td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        {{ $awb->destination }}</td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        {{ $awb->pcs }}</td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        {{ $awb->weight }}
                    </td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        {{ $awb->rate }}</td>
                    <td style="padding:2px 2px;border:1px solid #000;vertical-align:middle;text-align:center;">
                        {{ $awb->amount }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-bottom:none;"
                    colspan="4"><b>Remarks: </b> {{ $invoice->remarks }}</td>
                <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;" colspan="3">
                    <b>Total:</b>
                </td>
                <td style="padding:3px 3px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    {{ bcdiv($invoice->awbs->sum('pcs'), 1, 2) }}</td>
                <td style="padding:3px 3px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    {{ bcdiv($invoice->awbs->sum('weight'), 1, 2) }}</td>
                <td style="padding:3px 3px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    {{ bcdiv($invoice->awbs->sum('rate'), 1, 2) }}
                </td>
                <td style="padding:3px 3px;border:1px solid #000;vertical-align:middle;text-align:center;">
                    {{ $total }}</td>
            </tr>
            @if ($invoice->tiaCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">AWB Fee:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->tiaCharge }}</td>
                </tr>
            @endif
            @if ($invoice->surcharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-bottom:none;"
                        colspan="6">Fuel Sucharge:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->surcharge }}</td>
                </tr>
            @endif

            @if ($invoice->goodsPickupCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Goods Pickup Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->goodsPickupCharge }}</td>
                </tr>
            @endif
            @if ($invoice->shipmentPackageCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Shipment Packaging Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->shipmentPackageCharge }}</td>
                </tr>
            @endif
            @if ($invoice->shipmentHandelingCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Shipment Handling Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->shipmentHandelingCharge }}</td>
                </tr>
            @endif
            @if ($invoice->documentationHandlingCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Documentation & Handling:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->documentationHandlingCharge }}</td>
                </tr>
            @endif
            @if ($invoice->customClearingCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Custom Clearing Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->customClearingCharge }}</td>
                </tr>
            @endif
            @if ($invoice->perPackageCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Per Package Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->perPackageCharge }}</td>
                </tr>
            @endif

            @if ($invoice->weightDifferenceCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Weight Difference Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->weightDifferenceCharge }}</td>
                </tr>
            @endif


            @if ($invoice->cargoLoadingCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Cargo Loading Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->cargoLoadingCharge }}</td>
                </tr>
            @endif
            @if ($invoice->oversizeCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Over Size Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->oversizeCharge }}</td>
                </tr>
            @endif
            @if ($invoice->overweightCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Over Weight Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->overweightCharge }}</td>
                </tr>
            @endif
            @if ($invoice->remoteareaDeliveryCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Remote Delivery Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->remoteareaDeliveryCharge }}</td>
                </tr>
            @endif
            @if ($invoice->fumigationCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Fumigation Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->fumigationCharge }}</td>
                </tr>
            @endif
            @if ($invoice->detentionCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Detention Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->detentionCharge }}</td>
                </tr>
            @endif

            @if ($invoice->insuranceCharge > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Insurance Charges:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->insuranceCharge }}</td>
                </tr>
            @endif
            @if ($invoice->roundOff > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Round off:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->roundOff }}</td>
                </tr>
            @endif
            @if ($invoice->demurrage > 0)
                <tr>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="4"></td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;border-bottom:none;"
                        colspan="6">Demurrage:</td>
                    <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                        {{ $invoice->demurrage }}</td>
                </tr>
            @endif
            <tr>
                <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;" colspan="4">
                </td>
                <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;border-top:none;" colspan="6">
                    <b>Total Amount NPR</b>
                </td>
                <td style="padding:5px 10px;border:1px solid #000;vertical-align:middle;text-align:right;">
                    <b> {{ bcdiv($invoice->whole_total + $total, 1, 2) }}</b>
                </td>
            </tr>
            <tr>
                <td style="padding:15px 10px;border:1px solid #000;vertical-align:middle;border-top:none;" colspan="11">
                    <b>Amount in Words:</b>
                    <span
                        style="text-transform:uppercase;font-style:italic">{{ $format->format($invoice->whole_total + $total) }}
                        only</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="font-family: 'Montserrat', sans-serif;font-size: 14px;border-collapse: collapse;margin:auto;width:100%;">
        <tbody>
            <tr>
                <td style="padding:0px 7px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="line-height: 19px;font-size:16px;width:80%;"><b style="display: block;">Terms
                                        &
                                        Conditions:</b></td>
                                <td style="text-align: center; vertical-align:top;;font-size:13pt;width:20%;"
                                    rowspan="2"><br><br>_______________________<br>
                                    Account Department<br>
                                    Air Logistics Group</td>
                            </tr>
                            <tr>
                                <td style="line-height:20px;">
                                    <ul style="margin:0;padding:0;">
                                        1. Please collect a receipt from our payment collector for any payment of
                                        Cash/Cheque.<br />
                                        2. Payment against this invoice should be made only by an Account Payee
                                        cheque.<br />
                                        3. If any discrepancies found in invoice, should be lnformed & settled within
                                        seven
                                        days from invoice date.
                                    </ul>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table
        style="font-family: 'Montserrat', sans-serif;font-size: 14px;border-collapse: collapse;margin: -3px auto;width:100%;">
        <tbody>
            <tr>
                <td style="padding:0px 7px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="line-height:20px;">
                                    <ul style="margin:0;padding:0;">
                                        4. Failing to settle the payment within due date will attract an additional bank
                                        interest on the invoiced amount.
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table
        style="font-family: 'Montserrat', sans-serif;font-size: 14px;border-collapse: collapse;margin: -3px auto;width:100%;">
        <tbody>
            <tr>
                <td style="padding:0px 7px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="line-height:20px;">
                                    <ul style="margin:0;padding:0;">
                                        5. This invoice must be settled within the due date. Should you fail, ALG
                                        reserves the rights for legal action.
                                    </ul>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <div
        style="font-family: 'Montserrat', sans-serif;font-size:14px;text-align: center;margin-top:40px;font-weight:500;">
        This is computer generated invoice no signature and stamp required.
    </div>
    <div style="font-family: 'Montserrat', sans-serif;font-size:14px;text-align: center;">
        <p style="margin: 0;">2022 &copy; Copyright Air Logistics Group Pvt. Ltd.. All Rights Reserved</p>
        <p style="font-size:13pt;margin:0;">www.algxpress.com</p>
    </div>
    <script type="text/php">
        if ( isset($pdf) ) {  $font = $fontMetrics->get_font("helvetica", "500");$pdf->page_text(800, 1150, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0)); }
                            </script>
</body>


</html>
