<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Receipt</title>
    <style>
        * {
            font-size: 10px !important;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        table {
            border-collapse: collapse;
        }

        .bill-table0 th {
            font-weight: normal;
            padding: 10px;
        }

        .bill-wrap {
            max-width: 1000px;
            margin: 30px auto;
            background: #fff;
            padding: 50px;
        }

        .bill-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .bill-left h1 {
            margin: 0;
            text-align: center;
            font-weight: 500;
            font-size: 18px;
            text-transform: uppercase;
            line-height: 22px;
        }

        .bill-center span {
            display: block;
            font-size: 16px;
            font-weight: bold;
        }

        .bill-center p {
            margin: 0;
            margin-top: 3px;
            font-size: 15px;
        }

        .bill-center {
            text-align: center;
        }

        .bill-right p {
            margin: 0;
        }

        .bill-table1 th {
            text-align: left;
            padding: 0;
            border: 1px solid #794038;
        }

        .bill-table1 th b {
            background: #794038;
            display: block;
            color: #fff;
            padding: 6px 10px;
            text-transform: uppercase;
            font-size: 13px;
            vertical-align: middle;
        }

        .bill-table1 span {
            vertical-align: middle;
            padding-left: 10px;
        }

        .information-table td {
            border: none;
            padding: 6px;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: 600;
        }

        .information-table {
            border: none !important;
        }

        .bill-table2 th {
            border-top: none;
            background: #794038;
            color: #fff;
            padding: 6px 10px;
            text-align: left;
            border-right: 1px solid #63342e;
            text-transform: uppercase;
            font-size: 13px;
        }

        .bill-table2 td {
            vertical-align: top;
        }

        .bill-table2 p {
            font-size: 14px;
            line-height: 22px;
        }

        .bill-table2 p:last-child {
            margin-bottom: 0;
        }

        .bill-table2 p:first-child {
            margin-top: 0;
        }

        .bill-table2 span {
            text-transform: uppercase;
            font-weight: 600;
            min-height: 120px;
            line-height: 22px;
            display: flex;
            align-items: center;
            padding-bottom: 10px;
            text-align: center;
        }

        #table-three:first-child {
            top: 0px;
        }

        #table-three:last-child {
            bottom: 0px;
        }

        .price b {
            background: #794038;
            font-size: 13px;
            padding: 8px 10px;
            text-transform: uppercase;
            display: block;
            color: #fff;
            margin-left: -10px;
            margin-right: -10px;
        }

        .price p {
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 0;
            letter-spacing: .5px;
            margin-top: 0;
            padding-top: 15px;
        }

        .qty-table th {
            background: none !important;
        }

        .qty-table th {

            background: none !important;
            border-top: 1px solid #794038 !important;
            color: #000000 !important;
            border-bottom: 1px solid #794038;
        }

        .qty-table th b {
            display: block;
            text-align: center;
        }

        .qty-table th span {
            display: block;
            min-height: auto;
            padding-bottom: 0;
            line-height: normal;
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
        }

        .lists {
            display: flex;
            align-items: center;
            padding: 0;
            margin: 0;
            border-bottom: 1px solid #794038;
            margin-bottom: 10px;
        }

        .lists li span {
            min-height: auto;
            padding-bottom: 0;
            font-size: 13px;
            text-align: center;
            display: block;
        }

        .lists li {
            list-style: none;
            width: 33.3333%;
            text-align: center;
            border-right: 1px solid #794038;
            padding: 5px;
        }

        .lists li:last-child {
            border-right: none;
        }

        .dimensions {
            text-transform: uppercase;
            text-align: center;
            font-weight: 600;
            margin: 5px 0;
        }

        .qty-table th {
            border: none !important;
        }

        .qty-table td {
            border: none;
            text-align: center;
            padding: 10px;
        }

        .qty-table td+td::before {
            position: absolute;
            content: 'x';
            left: 0;
        }

        .qty-table td+td {
            position: relative;
        }

        .total {
            border-top: 1px solid #794038;
        }

        .total td+td::before {
            display: none;
        }

        .total td {
            vertical-align: middle;
            text-transform: uppercase;
            font-weight: 600;
        }

        .bill-table3 table {
            border-collapse: collapse;
        }

        .bill-table3 th {
            background: #794038;
            color: #fff;
            padding: 8px 10px;
            text-align: left;
            text-transform: uppercase;
            font-size: 13px;
            border-right: 1px solid #63342e;
        }

        .common-table td {
            border: none;
            padding: 5px 10px;
            text-transform: uppercase;
            font-size: 13px;
        }

        .common-table td b {
            border-bottom: 1px dashed #794038;
            display: inline-block;
            padding: 15px 0;
            padding-bottom: 7px;
        }

        .checkbox th {
            height: 20px;
            white-space: nowrap;
        }

    </style>
</head>

<body>

    {{-- <table width="100%" class="bill-table0">
        <thead>
            <tr>
                <th style="text-align:center;float: left;"><b style="font-size: 16px;text-transform:uppercase;">Air
                        Logistic <br>Group</b></th>
                <th><b>Air Waybill</b> <br>www.airlogisticgroup.com</th>
                <th style="float:right;">Kathmandu, Nepal</th>
            </tr>
        </thead>
    </table> --}}

    <table width="100%" class="bill-table1">
        <thead>
            <tr>
                <th width="50%" style="padding:0;">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th style="border:none;width:50%;padding:10px;">Shipper's Name and Address</th>
                                <th style="border:none;width:50%;padding:10px;">Shipper's Account Number</th>
                            </tr>
                            <tr>
                                <th style="border:none;width:50%;padding:10px;">Air Logistics group Pvt Ltd <br>Kathmandu, Nepal <br>Tel - 1234567890-</th>
                                <th style="border:none;width:50%;padding:10px;">Shipper's Account Number</th>
                            </tr>
                        </thead>
                    </table>
                </th>
                <th width="50%" style="padding:0;">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th style="border:none;width:80%;padding:10px;">Not Negotiable
                                    Air Waybill<br>
                                    Issued By<br>
                                    Nepal Airlines<br>
                                    Kathmandu, Nepal<br>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </th>
            </tr>
            <tr>
                <th width="50%" style="padding:0;">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th
                                    style="border:none;width:50%; text-align:center;padding:0;height:30px;line-height:30px;">
                                    <b>Customer
                                        Reference</b>
                                </th>
                                <th style="border:none;width:50%;padding:10px;">Pacific Export</th>
                            </tr>
                        </thead>
                    </table>
                </th>
                <th width="50%" style="padding:0;">
                    <table width="100%" class="checkbox">
                        <thead>
                            <tr>
                                <th style="border:none;padding:9px 10px;vertical-align:middle"><b
                                        style="display: inline-block;height:20px;width:20px;margin-right:10px;border-radius:2px;padding:0;background:transparent;border:1px solid #794038;"></b>Express
                                    Document</th>
                                <th style="border:none;padding:9px 10px;vertical-align:middle" class="active"><b
                                        style="display: inline-block;height:20px;width:20px;margin-right:10px;border-radius:2px;padding:0;background:transparent;background:#794038;"></b>Express
                                    Parcel</th>
                            </tr>
                        </thead>
                    </table>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border:1px solid #794038;">
                    <table width="100%" class="information-table">
                        <tbody>
                            <tr>
                                <td>From (Shipper):</td>
                                <td>Mr. Arjun Pandey</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>Kathmandu, Nepal</td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td>Kathmandu</td>
                            </tr>
                            <tr>
                                <td>State/Province:</td>
                                <td>Bagmati</td>
                            </tr>
                            <tr>
                                <td>Country:</td>
                                <td>Nepal</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>123 456 789</td>
                            </tr>
                            <tr>
                                <td>Postcode/Zip Code:</td>
                                <td>00966</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="border:1px solid #794038;">
                    <table width="100%" class="information-table">
                        <tbody>
                            <tr>
                                <td>From (Reciever):</td>
                                <td>Mr. Suryadeep Bhujel</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>Kathmandu, Nepal</td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td>Kathmandu</td>
                            </tr>
                            <tr>
                                <td>State/Province:</td>
                                <td>Bagmati</td>
                            </tr>
                            <tr>
                                <td>Country:</td>
                                <td>Nepal</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>123 456 789</td>
                            </tr>
                            <tr>
                                <td>Postcode/Zip Code:</td>
                                <td>00966</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" class="bill-table2">
        <thead>
            <tr>
                <th width="33.3333%">Conditions of Carriage</th>
                <th width="33.3333%">Description of Goods</th>
                <th width="33.3333%">Size & Weight</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="33.3333%" style="border:1px solid #794038;padding:10px;">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </td>
                <td width="33.3333%" style="border:1px solid #794038;padding:0;">
                    <p style="padding:10px">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th>Decleared Value for Custom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:10px;display:block;text-align:center;font-size:20px !important;">
                                    <b>USD:
                                        345.55</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="33.3333%" style="border:1px solid #794038;padding:0px;">
                    <table width="100%;">
                        <thead>
                            <tr>
                                <th
                                    style="background:transparent;color:#000;border-right:1px solid #794038;text-align:center;">
                                    No of Pieces</th>
                                <th
                                    style="background:transparent;color:#000;border-right:1px solid #794038;text-align:center;">
                                    Kilograms</th>
                                <th style="background:transparent;color:#000;border-right:none;text-align:center;">Grams
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom:1px solid #794038;border-right:1px solid #794038;padding: 10px;padding-top:0;text-align:center;font-weight:600;font-size:18px;">
                                    05</td>
                                <td
                                    style="border-bottom:1px solid #794038;border-right:1px solid #794038;padding: 10px;padding-top:0;text-align:center;font-weight:600;font-size:18px;">
                                    120</td>
                                <td
                                    style="border-bottom:1px solid #794038;border-right:1px solid #794038;padding: 10px;padding-top:0;text-align:center;font-weight:600;font-size:18px;">
                                    00</td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%;" class="qty-table">
                        <caption style="text-transform:uppercase;font-weight:600;padding:10px 10px 3px;">Dimension in Cm
                        </caption>
                        <thead>
                            <tr>
                                <th style="background:transparent;color:#000;border:none;">Pieces</th>
                                <th style="background:transparent;color:#000;border:none;">Length</th>
                                <th style="background:transparent;color:#000;border:none;">Weight</th>
                                <th style="background:transparent;color:#000;border:none;">Height</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center;font-size:15px;">05</td>
                                <td style="text-align:center;font-size:15px;">55</td>
                                <td style="text-align:center;font-size:15px;">65</td>
                                <td style="text-align:center;font-size:15px;">75</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size:15px;">05</td>
                                <td style="text-align:center;font-size:15px;">55</td>
                                <td style="text-align:center;font-size:15px;">65</td>
                                <td style="text-align:center;font-size:15px;">75</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;font-size:15px;">05</td>
                                <td style="text-align:center;font-size:15px;">55</td>
                                <td style="text-align:center;font-size:15px;">65</td>
                                <td style="text-align:center;font-size:15px;">75</td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td
                                    style="border-top:1px solid #794038;padding: 10px;border-right:1px solid #794038;text-transform:uppercase;text-align:center;font-weight:600;">
                                    Volumentric/Chargable Weight</td>
                                <td
                                    style="border-top:1px solid #794038;padding: 10px;font-weight:600;text-transform:uppercase;vertical-align:middle;font-size:16px;">
                                    120.00kg</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" class="bill-table3">
        <thead>
            <tr>
                <th>Shipper's Signature</th>
                <th>Agents's Signature</th>
                <th>Receiver's Signature</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="33.3333%" style="border:1px solid #794038;">
                    <table width="100%" class="common-table">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px;">Signature</td>
                                <td style="font-size: 13px;"><b>Suryadeep Bhujel</b></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Date</td>
                                <td style="font-size: 13px;">30/05/2021</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Time</td>
                                <td style="font-size: 13px;">01:45pm</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Name</td>
                                <td style="font-size: 13px;">Suryadeep Bhujel</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="33.3333%" style="border:1px solid #794038;">
                    <table width="100%" class="common-table">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px;">Signature</td>
                                <td style="font-size: 13px;"><b>Suryadeep Bhujel</b></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Date</td>
                                <td style="font-size: 13px;">30/05/2021</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Time</td>
                                <td style="font-size: 13px;">01:45pm</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Name</td>
                                <td style="font-size: 13px;">Suryadeep Bhujel</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="33.3333%" style="border:1px solid #794038;">
                    <table width="100%" class="common-table">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px;">Signature</td>
                                <td style="font-size: 13px;"><b>Suryadeep Bhujel</b></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Date</td>
                                <td style="font-size: 13px;">30/05/2021</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Time</td>
                                <td style="font-size: 13px;">01:45pm</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;">Name</td>
                                <td style="font-size: 13px;">Suryadeep Bhujel</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
