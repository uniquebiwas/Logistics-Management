<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
</head>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
    }

    #main-container {
        position: relative;
        width: 715px;
        max-width: 715px;
        height: 990px;
        max-height: 990px;
    }

    #body-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        z-index: 0;
        display: none;
    }

    table#table-header {
        border-bottom: none;
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 7px;
    }

    table#part1 {
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: none;
        border-collapse: collapse;
        width: 100%;
    }

    table#part2 {
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: none;
        border-collapse: collapse;
        width: 100%;
    }

    #part2 table {
        border-collapse: collapse;
    }

    table#part3 {
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: none;
        border-collapse: collapse;
        width: 100%;
    }

    table#part4 {
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: none;
        border-collapse: collapse;
        width: 100%;
    }

    table#part5 {
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: none;
        border-collapse: collapse;
        width: 100%;
    }

    table#part6 {
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: none;
        border-bottom: none;
        border-collapse: collapse;
        width: 100%;
    }

    td {
        font-size: 10px;
        padding: 1px;
        vertical-align: top;
    }

    .td-nop {
        padding: 2px 1px;
    }

    label {
        display: block;
        font-size: 6pt;
        line-height: 8px;
    }

    #part2 label {
        line-height: 6px;
    }

    input {
        width: 100%;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border-radius: 0;
        border: 1px solid #000;
        color: #000;
        height: 14px;
        padding: 0px 2px;
        outline: none;
        font-size: 8pt;
        margin: -1px;
        font-family: 'Roboto', sans-serif;

    }

    input:focus {
        border: none;
    }

    input:focus-visible {
        outline: none;
    }

    textarea {
        width: 100%;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border-radius: 0;
        border: 1px solid #000;
        resize: none;
        color: #000;
        padding: 0px 2px;
        outline: none;
        font-size: 9pt;
        margin: -1px;
        font-family: 'Roboto', sans-serif;
        line-height: 10px;
    }

    textarea:focus {
        border: none;
    }

    textarea:focus-visible {
        outline: none;
    }

    .bt {
        border-top: 1px solid black;
    }

    .bl {
        border-left: 1px solid black;
    }

    .br {
        border-right: 1px solid black;
    }

    .bb {
        border-bottom: 1px solid black;
    }

    p {
        font-size: 10px;
        margin: 0;
        padding: 0;
    }

    .extra-small-text label {
        font-size: 5pt;
    }

    .d-block {
        display: block;
    }

    .w-50 {
        width: 50%;
    }

    .w-25 {
        width: 25%;
    }

    .text-center {
        text-align: center;
    }

    .space {
        background-color: transparent;
        color: transparent;
    }

    .space-nobg {
        color: transparent;
    }

    #part4 #item1 textarea {
        padding-top: 10px;
    }

    @page {
        size: 210mm 297mm;
        margin: 13mm 3mm 12mm 16mm;
    }

    body,
    html {
        margin: 20px 3px 0px 28px;
    }

    /* @media print{

    } */
    /* Enable this for print */
    label {
        color: #fff;
        opacity: 0;
    }

    table#part1 {
        border-top: none;
        border-left: none;
        border-right: none;
    }

    table#part2 {
        border-top: none;
        border-left: none;
        border-right: none;
    }

    #part2 table {
        border-collapse: collapse;
    }

    table#part3 {
        border-top: none;
        border-left: none;
        border-right: none;
    }

    table#part4 {
        border-top: none;
        border-left: none;
        border-right: none;
    }

    table#part5 {
        border-top: none;
        border-left: none;
        border-right: none;
    }

    table#part6 {
        border-top: none;
        border-left: none;
    }

    input {
        border: none;
    }

    textarea {
        border: none;
    }

    textarea::-webkit-scrollbar {
        display: none;
    }

    .bt {
        border-top: none;
    }

    .bl {
        border-left: none;
    }

    .br {
        border-right: none;
    }

    .bb {
        border-bottom: none;
    }

</style>

<body>

    <div id="main-container">
        <table id="table-header">
            <tr>
                <td class="br" style="width: 4.75%;"><input type="text" name=""
                        value="{!! $neffa->firstRow['first'] !!}" class="text-center"
                        style="padding-bottom:8px;font-weight:bold;"></td>
                <td class="br" style="width: 4.75%;"><input type="text" name=""
                        value="{!! $neffa->firstRow['second'] !!}" class="text-center"
                        style="padding-bottom:8px;font-weight:bold;"></td>
                <td style="width: 12%;"><input type="text" name="" value="{!! $neffa->firstRow['third'] !!}"
                        style="padding-bottom:8px;font-weight:bold;padding-left: 5px;"></td>
                <td></td>
                <td style="width: 20%;"><input type="text" name="" value="{!! $neffa->firstRow['fourth'] !!}"
                        style="font-size: 9pt;padding-bottom:8px;font-weight:bold;"></td>
            </tr>
        </table>
        <table id="part1">
            <!-- Row starts here -->
            <tr>
                <td style="width: 24.3385%;">
                    <!-- <label for="">Shipper's Name and Address</label> -->
                    <div style="height:32px;"></div>
                </td>
                <td class="bb bl br" style="width: 24.3385%;height: 27px;">
                    <!-- <label for="">Shipper's account number</label> -->
                    <div style="height:16px;"></div>
                    <input type="text" class="text-center" name="" value="{!! $neffa->shipmentAccount !!}" />
                </td>
                <td class="" colspan="3" style="width: 51.323%;">
                    <div style="height:32px;"></div>
                    <!--  <label for="">Not Negotiable</label>
                    <p style="font-size: 9pt; font-weight: bold">Air Waybill</p> -->

                </td>
            </tr>
            <tr>
                <td class="br bb" colspan="2" rowspan="2" style="width: 48.677%;">
                    <textarea name=""
                        style="height:60px;text-transform: uppercase;position:absolute;">{!! $neffa->shipperDetails !!}</textarea>
                </td>
                <td colspan="3" style="width: 51.323%;height:45px;vertical-align: top;">
                    <!--  <label for="issuedBy" style="color: #fff;">Issued By:</label> -->
                    <textarea name="issuedBy"
                        style="width:305px;margin-left:50px;height: 45px;text-transform: uppercase;line-height:12px;"
                        id="issuedBy">{!! optional($neffa->airwayBill)['issuedBy'] !!}</textarea>
                </td>
            </tr>
            <tr>
                <td class="bb bt" colspan="3" style="width: 51.323%;">
                    <label>Copies 1, 2 and 3 of this Air Waybill are orginals and have the
                        same validity</label>
                </td>
            </tr>
            <!-- Row ends here -->
            <!-- Row starts here -->
            <tr>
                <td style="width: 24.3385%;">
                    <!-- <label for="">Consignee's Name and Address</label> -->
                    <div style="height:32px;"></div>

                </td>
                <td class="bb bl br" style="width: 24.3385%;">
                    <!-- <label for="">Consignee's Account Number</label> -->
                    <div style="height:18px;"></div>
                    <input type="text" class="text-center" name="" value="{!! $neffa->consigneeAccount !!}" />
                </td>
                <td class="bb" rowspan="2" colspan="3" style="width: 51.323%;">
                    <!-- <label for="" style="font-size: 6pt;line-height: 7px;">
                        It is agreed that the goods described herein are accepted in
                        apparent good order and condition (except as noted) for carriage
                        <b>SUBJECT TO THE CONTITIONS OF CONTRACT ON THE REVERSE HEREOF, ALL
                            GOODS MAY BE CARRIED BY ANY OTHER MEANS INCLUDING ROAD OR ANY
                            OTHER CARRIER UNLESS SPECIFIC CONTRARY INSTRUCTIONS ARE GIVEN
                            HEREON BY THE SHIPPER, AND SHIPPER AGREES THAT THE SHIPMENT MAY BE
                            CARRIED VIA INTERMEDIATE STOPPING PLACES WHICH THE CARRIER DEEMS
                            APPROPRIATE. THE SHIPPER'S ATTENTION IS DRAWN TO THE NOTICE
                            CONCERNING CARRIER'S LIMITATION OF LIABILITY.</b>
                        Shipper may increase such limitation of liability by declearing a
                        higher value of carriage and paying a supplemental charge if
                        required.
                    </label> -->
                    <div style="height:60px;"></div>
                </td>
            </tr>
            <tr>
                <td class="br bb" colspan="2" style="width: 48.677%;">
                    <textarea name="" style="height: 65px;text-transform: uppercase;">{!! $neffa->consigneeDetails !!}</textarea>
                </td>
            </tr>

            <!-- Row ends here -->
            <!-- Row starts here -->
            <tr>
                <td class="bb br" colspan="2" style="width: 48.677%;height: 61px;">
                    <!-- <label for="">Issuing Carrier's Agent Name and City</label> -->
                    <div style="height:19px;"></div>
                    <textarea name="" style="height: 50px;">{!! $neffa->agentDetails !!}</textarea>
                </td>
                <td rowspan="2" colspan="3" style="width: 51.323%;height:50px;">
                    <!-- <label for="">Accounting Information</label> -->
                    <div style="height:19px;"></div>
                    <textarea for=""
                        style="height: 65px;position:absolute;top:16px;padding-top:10px;padding-left:10px;">MODE OF PAYMENT: Prepaid</textarea>
                </td>
            </tr>
            <tr>
                <td class="w-25 br" style="width: 24.3385%;">
                    <!-- <label for="">Agent's IATA Code</label>  -->
                    <div style="height:18px;"></div>
                    <input type="text" name="" value="{!! $neffa->agentCode !!}" />
                </td>
                <td class="w-25 br" style="width: 24.3385%;">
                    <!-- <label for="">Account No.</label>  -->
                    <div style="height:18px;"></div>
                    <input type="text" name="" value="{!! $neffa->agentAccount !!}" />
                </td>
            </tr>
            <!-- Row ends here -->
            <!-- Row starts here -->
            <tr>
                <td class="bt br" rowspan="2" colspan="2" style="width: 48.677%;">
                    <!-- <label for="">Airport of Depature (Addr. of First Carrier) and Request
                        Routing</label> -->
                    <div style="height: 18px;"></div>
                    <input type="text" name="{!! $neffa->airportDepartures !!}" value="DUBAI INTL" />
                </td>
                <td class="br bt" style="width: 19.05%;">
                    <!-- <label for="">Reference Number</label> -->
                    <div style="height: 18px;"></div>
                </td>
                <td class="text-center br bt" style="width: 15.87%;">
                    <!-- <label for="">Optional Shipping Information</label> -->
                    <div style="height: 18px;"></div>
                </td>
                <td class="bt" style="width: 16.40%;">
                    <div style="height: 18px;"></div>
                </td>
            </tr>
            <tr>
                <td class="br" style="width: 19.05%;">
                    <input type="text" name="" style="padding-left:10px;" value="{!! $neffa->referenceNumber !!}" />
                </td>
                <td class="br bt" style="width: 15.87%;">
                    <input type="text" value="{!! $neffa->optionalShippingInformation[0] !!}" />
                </td>
                <td style="width: 16.40%;">
                    <input type="text" name="" class="text-center" value="{!! $neffa->optionalShippingInformation[1] !!}" />
                </td>
            </tr>
            <!-- Row ends here -->
        </table>
        <table id="part2">
            <tr>
                <td style="width: 48.677%;padding: 0px;">
                    <table style="width: 100%;" id="part2-1-1">
                        <tr>
                            <td class="br" style="width:10.87%" rowspan="2"><label for="">To</label></td>
                            <td class="" style="width:18.48%" rowspan="2">
                                <label for="">By First Carrier</label>
                            </td>
                            <td class="bl br bb extra-small-text text-center" style="width:31.53%"><label for="">Routing
                                    and
                                    Destination</label></td>
                            <td class="br" style="width:10.87%" rowspan="2"><label for="">To</label></td>
                            <td class="br" style="width:8.69%" rowspan="2"><label for="">By</label></td>
                            <td class="br" style="width:10.89%" rowspan="2"><label for="">To</label></td>
                            <td style="width:8.69%"><label for="" rowspan="2">By</label></td>
                        </tr>
                        <tr>
                            <td class="br extra-small-text" style="width:31.53%; color:transparent;"><label
                                    for="">Routing
                                    and Destination</label></td>
                        </tr>
                        <tr>
                            <td class="br"><input type="text" name="" value="{!! $neffa->airportTo !!}" />
                            </td>
                            <td class="br" colspan="2">
                                <input type="text" name="" value="{!! $neffa->carrierRouting !!}" />
                            </td>
                            <td class="br"><input type="text" name="" value="{!! $neffa->carrierTo !!}" />
                            </td>
                            <td class="br"><input type="text" name="{!! $neffa->carrierBy !!}" /></td>
                            <td class="br"><input type="text" name="" value="{!! $neffa->carrierTo2 !!}" />
                            </td>
                            <td class=""><input type="text" name="{!! $neffa->carrierBy2 !!}" /></td>


                        </tr>
                    </table>
                </td>
                <td style="width: 51.323%;padding: 0px;">
                    <table id="part2-1-2" style="width: 100%;border-left: none;">
                        <tr>
                            <td class="br" rowspan="2" style="width:10.31%"><label for="">Currency</label>
                            </td>
                            <td class="br text-center extra-small-text" rowspan="2" style="width:5.15%">
                                <label for="">CHGS <br />Code</label>
                            </td>
                            <td class="br bb text-center extra-small-text" colspan="2" style="width:10.31%">
                                <label for="">WT/VAL</label>
                            </td>
                            <td class="br bb text-center extra-small-text" colspan="2" style="width:10.31%">
                                <label for="">Other</label>
                            </td>
                            <td class="br text-center" rowspan="2" style="width:31.96%">
                                <label for="">Declared Value for Carriage</label>
                            </td>
                            <td class="br text-center" rowspan="2" style="width:31.96%">
                                <label for="">Declared Value for Customs</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="br text-center extra-small-text" style="width:5.155%"><label for="">PPD</label>
                            </td>
                            <td class="br text-center extra-small-text" style="width:5.155%"><label for="">COLL</label>
                            </td>
                            <td class="br text-center extra-small-text" style="width:5.155%"><label for="">PPD</label>
                            </td>
                            <td class="br text-center extra-small-text" style="width:5.155%"><label for="">COLL</label>
                            </td>
                        </tr>
                        <tr style="padding-right: 5px;">
                            <td class="br"><input type="text" name="" class="text-center"
                                    value="{!! $neffa->currency !!}" />
                            </td>
                            <td class="br"><input type="text" name="" class="text-center"
                                    value="{!! $neffa->code !!}" />
                            </td>
                            <td class="br"><input type="text" name="" class="text-center"
                                    value="{!! $neffa->valppd !!}" />
                            </td>
                            <td class="br"><input type="text" name="" class="text-center"
                                    value="{!! $neffa->valcoll !!}" />
                            </td>
                            <td class="br"><input type="text" name="" class="text-center"
                                    value="{!! $neffa->otherppd !!}" />
                            </td>
                            <td class="br"><input type="text" name="" class="text-center"
                                    value="{!! $neffa->othercoll !!}" />
                            </td>
                            <td class="br"><input type="text" name="" class="text-center"
                                    value="{!! $neffa->carriageValue !!}" />
                            </td>
                            <td class="br"><input type="text" name="" class="text-center"
                                    value="{!! $neffa->customerValue !!}" />
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td style="width: 48.677%;padding: 0px;">
                    <table style="width: 100%;" id="part2-2-1">
                        <tr>
                            <td class="w-50 br bt text-center">
                                <!--  <label for="">Airport of Destination</label> -->
                                <div style="height:15px;"></div>
                            </td>
                            <td class="w-25 br bb bt extra-small-text text-center" colspan="2">
                                <!--    <label for="">Requested Flight/Date</label> -->
                                <div style="height:15px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 br">
                                <input type="text" name="" value="MANCHESTER INTL" />
                            </td>
                            <td class="w-25 br">
                                <input type="text" name="" value="PC9003/16" />
                            </td>
                            <td class="w-25 br">
                                <input type="text" name="" value="PC1179/17" />
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 51.323%;padding: 0px;">
                    <table id="part2-2-2" style="width: 100%;">
                        <tr>
                            <td class="br bt text-center" style="width: 28.865%;">
                                <!--   <label for="">Amount of Insurance</label> -->
                                <div style="height:16px;"></div>
                            </td>
                            <td class="br bt" rowspan="2" style="width: 71.135%;">
                                <!-- <label for="">
                                    <span>INSURANCE-</span>If Carrier offers insurance, and such
                                    insurance is requested in accoudance with the condition
                                    therof,indecate amount to be insured in figures in box marked
                                    "Amount of insurance"
                                </label> -->
                                <div style="height:30px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25 br">
                                <input type="text" name="" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table id="part3">
            <tr>
                <td rowspan="2" style="width: 84.12%">
                    <!-- <label for="">Handling Information</label> -->
                    <div style="height: 18px;"></div>
                    <textarea for="" style="height: 50px;text-transform: uppercase;">{!! $neffa->handilingInformation !!}</textarea>
                </td>
                <td style="padding: 10px; width: 15%"></td>
            </tr>
            <tr>
                <td class="bt bl text-center" style="width: 15.88%">
                    <!-- <label for="">SCI</label>  -->
                    <div style="height: 18px;"></div>
                    <input type="text" value="{{ $neffa->sci }}" />
                </td>
            </tr>
        </table>
        <table id="part4">
            <tr>
                <td rowspan="2" class="text-center bb br" style="vertical-align: middle;width: 5.29%;height:30px;">
                    <!-- <label for="">No.of<br> Pieces<br>RCP</label> -->
                </td>
                <td rowspan="2" class="text-center bb br" style="vertical-align: middle;width: 8.5%;">
                    <!-- <label for="">Gross<br> Weight</label> -->
                </td>
                <td rowspan="2" class="text-center bb br" style="vertical-align: middle;width: 1.832%;">
                    <!-- <label for="">kg<br> lb</label> -->
                </td>
                <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                <td colspan="2" class="br" style="width: 10.852%;">
                    <!-- <label for="">Rate Class</label> -->
                    <div style="height: 13px;"></div>
                </td>
                <td rowspan="2" class="text-center br space" style="width: 1.832%;"></td>
                <td rowspan="2" class="text-center br bb" style="vertical-align: middle;width: 9.53%;">
                    <!-- <label for="">Chargeable<br>Weight</label> -->
                </td>
                <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                <td rowspan="2" class="text-center br bb" style="vertical-align: middle;width: 10.85%;">
                    <!-- <label for="">Rate<br>Charge</label> -->
                </td>
                <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                <td rowspan="2" class="text-center br bb" style="vertical-align: middle;width: 16.70%;">
                    <!-- <label for="">Total</label> -->
                </td>
                <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                <td rowspan="2" class="text-center br bb" style="vertical-align: middle;width: 29.33%;">
                    <!-- <label for="">Nature and Quantity of Goods<br>(incl. Dimensions of Volume)</label> -->
                </td>
            </tr>
            <tr>
                <td class="space-nobg br" style="width: 1.322%;"></td>
                <td colspan="2" class="bt bb br" style="width: 9.53%;">
                    <!-- <label for="">Commodity<br>Item No.</label> -->
                    <div style="height: 13px;"></div>
                </td>
            </tr>
            <tr id="item1" style="position: relative">
                <div class="notify-horizontal" style="position: absolute;top:56%;left:6%;width:60%;">
                    <textarea style="color: #000;font-size:9pt;  font-family: 'Roboto', sans-serif;"></textarea>
                </div>
                <td class="br" style="height: 192px;"><textarea for=""
                        style="height: 186px;">{!! $neffa->piecesNumber !!}</textarea>
                </td>
                <td class="br"><textarea for="" class="text-center"
                        style="height: 186px;">{!! $neffa->grossWeight !!}</textarea></td>
                <td class="br td-nop"><textarea for="" style="height: 186px;">{!! $neffa->kg !!}</textarea>
                </td>
                <td class="space br"></td>
                <td class="br"><textarea for=""
                        style="height: 186px;margin-left:-2px;">{!! $neffa->rateClass !!}</textarea></td>
                <td class="br"><textarea for="" style="height: 186px;">{!! $neffa->commodity !!}</textarea>
                </td>
                <td class="space br"></td>
                <td class="br"><textarea for="" class="text-center"
                        style="height: 186px;">{!! $neffa->chargeableWeight !!}</textarea></td>
                <td class="space br"></td>
                <td class="br"><textarea for="" class="text-center"
                        style="height: 186px;">{!! $neffa->rate !!}</textarea></td>
                <td class="space br"></td>
                <td class="br"><textarea for="" class="text-center"
                        style="height: 186px;">{!! $neffa->total !!}</textarea></td>
                <td class="space br"></td>
                <td class="br"><textarea for=""
                        style="text-transform: uppercase;height: 186px;padding-left:10px;">{!! $neffa->nature !!}
                </textarea></td>
            </tr>
            <tr id="item-total">
                <td class="bt br" style="vertical-align: middle;height: 25px;"><input type="text"
                        value="{{ $neffa->wholeTotal[0] }}">
                </td>
                <td class="bt br" style="vertical-align: middle;"><input type="text" class="text-center"
                        value="{{ $neffa->wholeTotal[1] }}"></td>
                <td class="space-nobg br"></td>
                <td class="space br"></td>
                <td class="space-nobg br"></td>
                <td class="space-nobg br"></td>
                <td class="space br"></td>
                <td class="space-nobg br"></td>ss
                <td class="space br"></td>
                <td class="space-nobg br"></td>
                <td class="space br"></td>
                <td class="bt br" style="vertical-align: middle;"><input type="text" class="text-center"
                        value="{{ $neffa->wholeTotal[2] }}"></td>
                <td class="space br"></td>
                <td class="space-nobg br" style="vertical-align: middle;"><input type="text"
                        style="padding-left:10px;" value="{{ $neffa->wholeTotal[3] }}"></td>
            </tr>
        </table>

        <table id="part5">
            <tr>
                <td style="width: 38.1%" class="text-center bb br" colspan="2">
                    <!--  <label for="">Weight Charge</label> -->
                    <div style="height:15px;"></div>
                </td>
                <td rowspan="6" colspan="3" class="bl">
                    <!--    <label for="">Other Charges</label>  -->
                    <div style="height:15px;"></div>
                    <textarea for="" style="height: 65px;">{!! $neffa->information['otherCharge'] !!}</textarea>
                </td>

            </tr>
            <tr>
                <td style="width: 19.05%" class="br"><input type="text" name="" class="text-center"
                        value="{!! $neffa->prepaidWeightCharge !!}" />
                </td>
                <td style="width: 19.05%"><input type="text" name="" class="text-center"
                        value="{!! $neffa->collectWeightCharge !!}" /></td>
            </tr>
            <tr>
                <td style="width: 38.1%" class="text-center bb br bt" colspan="2">
                    <label for="">Valuation Charge</label>
                    <!--  <div style="height:11px;"></div> -->
                </td>
            </tr>
            <tr>
                <td style="width: 19.05%" class="br"><input type="text" name="" class="text-center"
                        value="{!! $neffa->prepaidValuationCharge !!}" />
                </td>
                <td style="width: 19.05%"><input type="text" name="" class="text-center"
                        value="{!! $neffa->prepaidValuationCharge !!}" /></td>
            </tr>
            <tr>
                <td style="width: 38.1%" class="text-center bb br bt" colspan="2">
                    <label for="">Tax</label>
                    <!--  <div style="height:11px;"></div> -->
                </td>
            </tr>
            <tr>
                <td style="width: 19.05%" class="br"><input type="text" name="" class="text-center"
                        value="{!! $neffa->prepaidTax !!}" />
                </td>
                <td style="width: 19.05%"><input type="text" name="" class="text-center"
                        value="{!! $neffa->collectTax !!}" /></td>
            </tr>
            <tr>
                <td style="width: 38.1%" class="text-center bb br bt" colspan="2">
                    <!--   <label for="">Total Other Charges Due Agent</label> -->
                    <div style="height:15px;"></div>
                </td>
                <td rowspan="2" colspan="3" class="bl bt">
                    <label for="" style="font-size: 6pt;line-height: 10px;">
                        <span>
                            Shipper certifes that the particular on the face hereof are
                            correct and that
                        </span><b>
                            insofar asw any part of the copnsignment contents dangerous goods,
                            such part is properly described by name and is in proper condition
                            for carriage by air according to the applicable Dengerous Goods
                            Regulations.</b>
                    </label>
                    <!--    <div style="height:11px;"></div> -->
                </td>
            </tr>
            <tr>
                <td style="width: 19.05%" class="br"><input type="text" class="text-center" name=""
                        value="{!! $neffa->prepaidDueAgent !!}" /></td>
                <td style="width: 19.05%"><input type="text" class="text-center" name=""
                        value="{!! $neffa->collectDueAgent !!}" /></td>
            </tr>
            <tr>
                <td style="width: 38.1%" class="text-center bb br bt" colspan="2">
                    <!--   <label for="">Total Other Charges Due Carrier</label> -->
                    <div style="height:15px;"></div>
                </td>
                <td rowspan="2" colspan="3">
                    {{-- <textarea for="" style="text-transform: uppercase;height: 35px;padding-top:15px;">{!! $neffa->information !!}</textarea> --}}
                </td>
            </tr>
            <tr>
                <td style="width: 19.05%;max-height:5px;" class="br bb"><input type="text"
                        class="text-center" name="" value="{!! $neffa->prepaidDueCarrier !!}" /></td>
                <td style="width: 19.05%max-height:5px;" class="br bb bl"><input type="text"
                        class="text-center" name="" value="{!! $neffa->collectDueCarrier !!}" /></td>
            </tr>
            <tr>
                <td style="width: 19.05%;max-height:5px;" class="text-center br space"></td>
                <td style="width: 19.05%;max-height:5px;" class="text-center br space"></td>
                <td colspan="3"><input type="text" style="text-align: center;"
                        name="agent" value="{{ $neffa->information['agent'] }}"></td>
            </tr>
            <tr>
                <td style="width: 19.05%;" class="br space"></td>
                <td style="width: 19.05%;" class="bl br space"></td>
                <td></td>
                <td class="bb">
                    <label for="">Signature of Shipper or his Agent</label>
                    <!--  <div style="height: 4px;"></div>  -->
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 19.05%" class="text-center bb br bt">
                    <!--  <label for="">Total Prepaid</label> -->
                    <div style="height:15px;"></div>
                </td>
                <td style="width: 19.05%" class="text-center bb br bt">
                    <!--  <label for="">Total Collect</label> -->
                    <div style="height:15px;"></div>
                </td>
                <td style="border-bottom: 1px dotted #fff;" rowspan="3" colspan="3" class="bl bt">
                    <textarea for="" rows="3"
                        style="height:45px;position: absolute;padding-top:25px;">{!! $neffa->information['carrierAgent'] !!}</textarea>
                </td>
            </tr>
            <tr>
                <td style="width: 19.05%" class="br"><input type="text" name="" class="text-center"
                        value="{!! $neffa->totalPrepaid !!}" />
                </td>
                <td style="width: 19.05%"><input type="text" name="" class="text-center"
                        value="{!! $neffa->totalCollect !!}" /></td>
            </tr>
            <tr>
                <td style="width: 19.05%" class="text-center bb br bt">
                    <label for="">Currency Conversion Rates</label>
                    <!-- <div style="height:5px;"></div> -->
                </td>
                <td style="width: 19.05%" class="text-center bb br bt">
                    <label for="">CC Charges in Dest. Currency</label>
                    <!--  <div style="height:5px;"></div>-->
                </td>
            </tr>
            <tr>
                <td style="width: 19.05%" class="br"><input type="text" name="{!! $neffa->currencyConversion !!}" />
                </td>
                <td style="width: 19.05%" class="br"><input type="text" name="{!! $neffa->ccDestinationCharge !!}" />
                </td>
                <td style="width: 20.22%">
                    <label for="">Executed on (date)</label>
                    <!--     <div style="height: 8px;"></div> -->
                </td>
                <td style="width: 19.05%">
                    <label for="">at (place)</label>
                    <!--   <div style="height: 8px;"></div> -->
                </td>
                <td style="width: 22.63%;text-align: right;vertical-align: bottom;">
                    <label for="">Signature of issuing Carrier ot its Agent</label>
                    <!--  <div style="height: 8px;"></div> -->
                </td>
            </tr>

        </table>
        <table id="part6">
            <tr>
                <td style="width: 19.05%;vertical-align: middle;" colspan="2" rowspan="2" class="text-center br bb">
                    <label for="">For Carrier's Use only<br> at Destination</label>
                    <!--   <div style="height:30px;"></div>  -->
                </td>
                <td style="width: 19.05%" class="br bb text-center">
                    <label for="">Charges at Destination</label>
                    <!--    <div style="height:9px;"></div>  -->
                </td>
                <td style="width: 19.05%" class=" br bb text-center">
                    <label for="">Total Collect Charges</label>
                    <!--   <div style="height:9px;"></div> -->
                </td>
                <td style="width: 42.85%" class="text-center"></td>
            </tr>
            <tr>
                <td style="width: 19.05%" class="br bb"><input type="text" name=""
                        value="{!! $neffa->destinationCharge !!}"></td>
                <td style="width: 19.05%" class="br bb"><input type="text" name=""
                        value="{!! $neffa->totalCollectCharge !!}"></td>
                <td style="width: 42.85%"><input type="text" class="text-center"
                        style="font-size: 9pt;padding-bottom:8px;font-weight:bold;" value="{!! $neffa->bottomCode !!}">
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
