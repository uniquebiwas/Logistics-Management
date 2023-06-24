<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PDF File</title>
    <link rel="stylesheet" href="">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <table
        style="font-family: 'Roboto', sans-serif;font-size: 16px;padding:10px 0px;border-collapse: collapse;margin:auto;width:100%;background:#fff;">
        <thead>
            <tr>
                <th style="text-align: left;padding:20px;vertical-align:top;">
                    <img src="img/logo.png" alt="images" style="max-width: 200px;">
                </th>
                <th style="text-align: left;font-weight:normal;line-height: 22px;padding:20px;">
                    <table style="margin-left: auto;">
                        <thead>
                            <tr>
                                <td style="padding:1px 10px 10px;">
                                    <b
                                        style="font-size: 25px;display: block;font-weight: 600;margin-bottom: -20px;color: #6b0b0c;">{{ config('settings.name') }}</b>
                                    <br>
                                    {{ congif('settings.address') }} <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="padding:1px 10px;"><b>Tel:</b></td>
                                                <td style="padding:1px 10px;">977 123 456 789 </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px 10px;"><b>Fax:</b></td>
                                                <td style="padding:1px 10px;">977 123 456 789</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px 10px;"><b>E-mail:</b></td>
                                                <td style="padding:1px 10px;">{{ config('settings.email') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px 10px;"><b>Website:</b></td>
                                                <td style="padding:1px 10px;">977 123 456 789</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px 10px;"><b>Pan No:</b></td>
                                                <td style="padding:1px 10px;">{{ congif('settings.pan') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </th>
            </tr>
        </thead>
    </table>
    <table
        style="font-family: 'Roboto', sans-serif;font-size: 13px;padding:10px 0px;border-collapse: collapse;margin:auto;width:100%;">
        <thead>
            <tr>
                <th style="text-align: center;border-top:none;">
                    <b style="background: #6b0b0c;
         color: #fff;
         display: block;
         padding: 5px 8px;
         font-size: 16px;
         font-weight: 500;
         letter-spacing: .5px;
         border-radius: 4px;
         text-transform: uppercase;
         max-width: 65px;
         margin-left: auto;
         margin-right: auto;">Invoice</b>
                </th>
            </tr>
            <tr>
                <th style="font-size:16px;padding-top:7px;">Cargo</th>
            </tr>
        </thead>
    </table>
    <table width="100%" style="border-top:2px dashed #6b0b0c;margin-top:20px;margin-bottom:20px;">
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table
        style="font-family: 'Roboto', sans-serif;font-size: 16px;border-collapse: collapse;width:100%;background:#fff;">
        <tbody>
            <tr style="">
                <td style="border-top:none;width:50%;">
                    <table>
                        <tbody>
                            <tr>
                                <td style="padding:3px 10px;">Invoice No:</td>
                                <td style="padding:3px 10px;">{{ $invoice->id }}</td>
                            </tr>
                            @dd($invoice)
                            @if ($invoice->parentInvoice->id)
                            <tr>
                                <td style="padding:3px 10px;">Ref Inv No:</td>
                                <td style="padding:3px 10px;">{{ $invoice->parentInvoice->id }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td style="padding:3px 10px;">VAT No:</td>
                                <td style="padding:3px 10px;">{{ $invoice->vatNumber }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px;">Customer Account:</td>
                                <td style="padding:3px 10px;">{{ $invoice->customerAccount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="border-top:none;width:50%;">
                    <table>
                        <tbody>
                            <tr style="">
                                <td style="padding:3px 10px;">Date:</td>
                                <td style="padding: 3px 10px;
         white-space:nowrap;">{{ $invoice->date }}</td>
                            </tr>
                            <tr style="">
                                <td style="padding:3px 10px;">Memo Type:</td>
                                <td style="padding: 3px 10px;

          ">Credit</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 10px 0;">Customer's VAT No:</td>
                                <td style="padding:3px 10px 0;">{{ $invoice->customerVatNumber }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table
        style="font-family: 'Roboto', sans-serif;font-size: 16px;padding:10px 0;border-collapse: collapse;background:#fff;margin-top:-6px;">
        <tbody>
            <tr>
                <td style="padding:0px 12px 0px;white-space: nowrap;">Customer's Name:</td>
                <td style="padding:0px 12px 0px;padding-left:0;">
                    {{ $invoice->customerName }}
                </td>
            </tr>
        </tbody>
    </table>
    <table
        style="width:100%; font-family: 'Roboto', sans-serif;font-size: 16px;border-collapse: collapse;background:#fff;margin-top:-4px;">
        <tbody>
            <tr>
                <td style="padding:0px 10px;width:50%;">
                    <table>
                        <tbody>
                            <tr>
                                <td>Address:</td>
                                <td>Kathmandu, Nepal</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="padding:0px 10px;width:50%;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>Make of Payment:</td>
                                <td style="white-space: nowrap;vertical-align:middle;">
                                    <label class="checkbox-inline" style="vertical-align: middle;">
                                        <input style="vertical-align: middle;margin-top:3px;margin-right:3px;"
                                            type="checkbox" value="" @if ($invoice->paymentType == 'cash')
                                        checked
                                        @endif>Cash
                                    </label>
                                    <label class="checkbox-inline" style="vertical-align: middle;">
                                        <input style="vertical-align: middle;margin-top:3px;margin-right:3px;"
                                            type="checkbox" value="" @if ($invoice->paymentType == 'credit')
                                        checked
                                        @endif
                                        >Credit
                                    </label>
                                    <label class="checkbox-inline" style="vertical-align: middle;">
                                        <input style="vertical-align: middle;margin-top:3px;margin-right:3px;"
                                            type="checkbox" value="" @if ($invoice->paymentType == 'cheque')
                                        checked
                                        @endif>Cheque
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="border-top:2px dashed #6b0b0c;margin-top:20px;margin-bottom:20px;">
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table
        style="font-family: 'Roboto', sans-serif;font-size: 16px;padding:10px 0px;border-collapse: collapse;margin:auto;width:100%;background:#fff;">
        <thead>
            <tr>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">S.N</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">AWB No</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">AWB Date</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">Consignee</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">Destination</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">Content</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">Pieces</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">Weight</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #ffffff57;font-weight:500;">Amount</th>
                <th style="border: 1px solid #6b0b0c;
      padding: 8px;
      background: #6b0b0c;
      color: #fff;border-right: 1px solid #6b0b0c;font-weight:500;">Ex. Rate</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->shipmentPackages as $key => $package)
                <tr>
                    <td style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;">
                        {{ $key + 1 }}
                    </td>
                    <td style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;">
                        {{ $package->awb_number }}</td>
                    <td style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;">
                        {{ $package->shipment_date->format('Y/m/d') }}</td>
                    <td style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;">
                        {{ $package->senderAttention }}
                    </td>
                    <td
                        style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;border-right:none;">
                        {{ $package->receiverAddress }}</td>
                    <td
                        style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;border-right:none;">
                        {{ $package->content }}</td>
                    <td
                        style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;border-right:none;">
                        {{ $package->totalPiece }}</td>
                    <td
                        style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;border-right:none;">
                        {{ $package->total_chargeable_weight }}
                    </td>
                    <td
                        style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;border-right:none;">
                        {{ $package->value }}</td>
                    <td style="text-align: center;border: 1px solid #6b0b0c;padding:8px;border-top:none;">
                        120</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <table width="100%" style="border-top:2px dashed #6b0b0c;margin-top:20px;margin-bottom:20px;">
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table width="100%">
        <tbody>
            <td width="70%"></td>
            <td width="30%">
                <table
                    style="font-family: 'Roboto', sans-serif;font-size: 16px;padding:0px 0px 10px;border-collapse: collapse;text-align;right;background:#fff;width:100%;">
                    <tbody>
                        <tr>
                            <td style="padding:5px 10px;"><b>Basic Total:</b></td>
                            <td style="padding:5px 10px;text-align:right;">{{ $invoice->basicTotal }}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 10px;"><b>Fuel Sucharge:</b></td>
                            <td style="padding:4px 10px;text-align:right;">{{ $invoice->fuelCharge }}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 10px;"><b>TIA Sucharge:</b></td>
                            <td style="padding:4px 10px;text-align:right;">{{ $invoice->tiaCharge }}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 10px;"><b>Sucharge:</b></td>
                            <td style="padding:4px 10px;text-align:right;">{{ $invoice->surcharge }}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 10px;"><b>Total Non-taxable Amount:</b></td>
                            <td style="padding:4px 10px;text-align:right;">{{ $invoice->nonTaxableAmount }}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 10px;"><b>Total Taxable Amount:</b></td>
                            <td style="padding:4px 10px;text-align:right;">{{ $invoice->taxableAmount }}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 10px;"><b>VAT 13%:</b></td>
                            <td style="padding:4px 10px;text-align:right;">{{ $invoice->vatAmount }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tbody>
    </table>

    <table width="100%" style="border-top:2px dashed #6b0b0c;margin-top:20px;margin-bottom:10px;">
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table
        style="font-family: 'Roboto', sans-serif;font-size: 16px;padding:10px 0px;border-collapse: collapse;width:100%;background:#fff;">
        <tbody>
            <tr>
                <td width="57%"><b>In Words:</b> Rs. {{ $format->format($invoice->whole_total) }}</td>
                <td style="text-align: right;"><b>Net Amount:</b></td>
                <td style="text-align: right;"><b>{{ $invoice->whole_total }}</b></td>
            </tr>
        </tbody>
    </table>
    <table
        style="font-family: 'Roboto', sans-serif;font-size: 16px;padding:10px 0px;border-collapse: collapse;margin:auto;width:100%;background:#fff;">
        <tbody>
            <tr>
                <td style="padding:10px 0px;">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="line-height: 19px;font-size:16px;"><b
                                        style="display: block;margin-top:10px;">Terms & Conditions:</b></td>
                            </tr>
                            <tr>
                                <td style="line-height: 24px;">
                                    1. Payment against this invoice should be made only by an Account Payee
                                    cheque.<br />
                                    2. Please collect a receipt from our payment collector for any payment of
                                    Cash/Cheque.<br />
                                    3. If any discrepancies found in invoice, should be lnformed & settled within seven
                                    days from involce date.<br />
                                    4. Failing to settle the payment within due date will attract an additional bank
                                    interest on the Involced amount.<br />
                                </td>
                            </tr>
                            {{-- <tr>
                                <td style="line-height: 24px;padding-top:20px;text-align:center;">
                                    <b>For: Airlogistic Group Pvt. Ltd.</b>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table
        style="font-family: 'Roboto', sans-serif;font-size: 16px;padding:10px 0px;border-collapse: collapse;margin:auto;width:100%;background:#fff;">
        <tbody>
            <tr>
                <td style="padding:10px 10px;text-align: center;width:50%;">
                    <table>
                        <tbody>
                            <tr>
                                <td> <b>For: Airlogistic Group Pvt. Ltd.</b></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="padding:10px 10px;text-align: center;width:50%;">
                    <table style="margin-left:auto;">
                        <tbody>
                            <tr>
                                <td>Signature</td>
                                <td>..................................................</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
