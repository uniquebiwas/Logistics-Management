@extends('layouts.admin')
@section('title', 'neffa')
@push('styles')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            position: relative;
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
        }

        table#part1 {
            border-top: 1px solid black;
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: none;
            border-collapse: collapse;
            width: 100%;
        }

        #part2{
            margin: 0;
        }
        #part2 table {
            border-top: 1px solid black;
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: none;
            border-collapse: collapse;
            width: 100%;
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
            padding: 2px;
            vertical-align: top;
        }

        .td-nop {
            padding: 2px 1px;
        }

        label {
            display: block;
            font-size: 6.5pt;
            line-height: 10px;
            margin: 0
        }

        input {
            width: 100%;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            border-radius: 0;
            border: 1px solid #bfbfbf;
            z-index: 99;
            background-color: #fff;
            opacity: 0.99;
            color: #000;
        }

        input:focus {
            border: 1px solid #9d9d9d;
        }

        input:focus-visible {
            outline: 1px solid #9d9d9d;
        }

        textarea {
            width: 100%;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            border-radius: 0;
            border: 1px solid #bfbfbf;
            resize: none;
            z-index: 99;
            background-color: #fff;
            opacity: 0.99;
            color: #000;
        }

        textarea:focus {
            border: 1px solid #9d9d9d;
        }

        textarea:focus-visible {
            outline: 1px solid #9d9d9d;
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
            font-size: 7px;
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

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            /* margin-right: -15px;
                                                                                    margin-left: -15px; */
        }

        .col-6-1 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 48.677%;
            flex: 0 0 48.677%;
            max-width: 48.677%;
        }

        .col-6-2 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 51.323%;
            flex: 0 0 51.323%;
            max-width: 51.323%;
        }

        .space {
            background-color: #9f9f9f;
            opacity: 1;
            color: transparent;
        }

        .space-nobg {
            color: transparent;
        }

        @media print {
            #body-overlay {
                display: block;
            }

            table {
                border: 1px solid transparent;
            }
        }

    </style>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">MasterWay Bill</h3>
                    <div class="card-tools">
                        <a href="{{ route('neffa.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($neffa->id)
                        {!! Form::open(['url' => route('neffa.update', ['neffa' => $neffa->id])]) !!}
                        @method('PATCH')
                    @else
                        {!! Form::open(['url' => route('neffa.store', ['type' => request()->type])]) !!}
                    @endif
                    <div id="body-overlay"></div>
                    <table id="table-header">
                        <tr>
                            <td class="br" style="width: 4.75%;"><input type="text" name="first"
                                    value="{{ optional($neffa->firstRow)['first'] }}"></td>
                            <td class="br" style="width: 4.75%;"><input type="text" name="second"
                                    value="{{ optional($neffa->firstRow)['second'] }}"></td>
                            <td style="width: 12%;"><input type="text" name="third"
                                    value="{{ optional($neffa->firstRow)['third'] }}"></td>
                            <td></td>
                            <td style="width: 20%;"><input type="text" name="fourth"
                                    value="{{ optional($neffa->firstRow)['fourth'] }}"></td>
                        </tr>
                    </table>
                    <table id="part1">
                        <!-- Row starts here -->
                        <tr>
                            <td style="width: 24.3385%;">
                                <label for="">Shipper's Name and Address</label>

                            </td>
                            <td class="bb bl br" style="width: 24.3385%;">
                                <label for="">Shipper's Account Number</label>
                                <input type="text" name="shipmentAccount"
                                    value="{{ old('shipmentAccount', $neffa->shipmentAccount) }}" />
                            </td>
                            <td class="" colspan="3" style="width: 51.323%;">
                                <label for="">Not Negotiable</label>
                                <p style="font-size: 18px; font-weight: bold">Air Waybill</p>
                                <!-- <label for="">Issued by</label> -->
                            </td>
                        </tr>
                        <tr>
                            <td class="br bb" colspan="2" rowspan="3" style="width: 48.677%;">
                                <textarea name="shipperDetails" rows="5">{!! old('shipperDetails', $neffa->shipperDetails) !!}</textarea>
                            </td>
                            <td colspan="3" style="vertical-align: bottom;width: 51.323%;"><span>Issued By: </span>
                                {{-- <input type="text" style="display: inline-block;width: 90%;"></td> --}}
                        </tr>
                        <tr>

                            <td class="bb" colspan="3" style="width: 51.323%;">
                                <textarea name="issuedBy">{!! old('issuedBy', optional($neffa->airwayBill))['issuedBy'] !!}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="bb" colspan="3" style="width: 51.323%;">
                                <label>Copies 1, 2 and 3 of this Air Waybill are orginals and have the
                                    same validity</label>
                            </td>
                        </tr>
                        <!-- Row ends here -->
                        <!-- Row starts here -->
                        <tr>
                            <td style="width: 24.3385%;">
                                <label for="">Consignee's Name and Address</label>

                            </td>
                            <td class="bb bl br" style="width: 24.3385%;">
                                <label for="">Consignee's Account Number</label>
                                <input type="text" name="consigneeAccount"
                                    value="{{ old('consigneeAccount', $neffa->consigneeAccount) }}" />
                            </td>
                            <td class="bb" rowspan="2" colspan="3" style="width: 51.323%;">
                                <p style="font-size: 6.5pt;line-height: 10px;">
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
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="br bb" colspan="2" style="width: 48.677%;">
                                <textarea name="consigneeDetails">{!! old('consigneeDetails', $neffa->consigneeDetails) !!}</textarea>
                            </td>
                        </tr>

                        <!-- Row ends here -->
                        <!-- Row starts here -->
                        <tr>
                            <td class="bb br" colspan="2" style="width: 48.677%;">
                                <label for="">Issuing Carrier's Agent Name and City</label>
                                <textarea name="agentDetails">{!! old('agentDetails', $neffa->agentDetails) !!}</textarea>
                            </td>
                            <td rowspan="2" colspan="3" style="width: 51.323%;">
                                <label for="">Accounting Information</label>
                                <textarea for="" rows="4" name="accountingInformation">{!! old('accountingInformation', optional($neffa->airwayBill)['accountingInformation']) !!}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25 br" style="width: 24.3385%;">
                                <label for="">Agent's IATA Code</label> <input type="text" name="agentCode"
                                    value="{{ old('agentCode', $neffa->agentCode) }}" />
                            </td>
                            <td class="w-25 br" style="width: 24.3385%;">
                                <label for="">Account No.</label> <input type="text" name="agentAccount"
                                    value="{{ old('agentAccount', $neffa->agentAccount) }}" />
                            </td>
                        </tr>
                        <!-- Row ends here -->
                        <!-- Row starts here -->
                        <tr>
                            <td class="bt br" rowspan="2" colspan="2" style="width: 48.677%;">
                                <label for="">Airport of Depature (Addr. of First Carrier) and Request
                                    Routing</label>
                                <input type="text" name="airportDepartures"
                                    value="{{ old('airportDepartures', $neffa->airportDepartures) }}" />
                            </td>
                            <td class="br bt" style="width: 19.05%;">
                                <label for="">Reference Number</label>
                            </td>
                            <td class="text-center br bt" style="width: 15.87%;">
                                <label for="" style="font-size: 8px;">Optional Shipping Information</label>
                            </td>
                            <td class="bt" style="width: 16.40%;"></td>
                        </tr>
                        <tr>
                            <td class="br" style="width: 19.05%;">
                                <input type="text" name="referenceNumber"
                                    value="{{ old('referenceNumber', $neffa->referenceNumber) }}" />
                            </td>
                            <td class="br bt" style="width: 15.87%;">
                                <input type="text" name="optionalShippingInformation[]"
                                    value="{{ old('optionalShippingInformation', optional($neffa->optionalShippingInformation)[0]) }}" />
                            </td>
                            <td style="width: 16.40%;">
                                <input type="text" name="optionalShippingInformation[]"
                                    value="{{ optional($neffa->optionalShippingInformation)[1] }}" />
                            </td>
                        </tr>
                        <!-- Row ends here -->
                    </table>
                    <div class="row" id="part2">
                        <div class="col-6-1">
                            <table style="width: 100%;">
                                <tr>
                                    <td class="br" style="width:10.87%" rowspan="2"><label for="">To</label>
                                    </td>
                                    <td class="" style="width:18.48%" rowspan="2">
                                        <label for="">By First Carrier</label>
                                    </td>
                                    <td class="bl br bb extra-small-text text-center" style="width:31.53%"><label
                                            for="">Routing and Destination</label></td>
                                    <td class="br" style="width:10.87%" rowspan="2"><label for="">To</label>
                                    </td>
                                    <td class="br" style="width:8.69%" rowspan="2"><label for="">By</label></td>
                                    <td class="br" style="width:10.89%" rowspan="2"><label for="">To</label>
                                    </td>
                                    <td style="width:8.69%"><label for="" rowspan="2">By</label></td>
                                </tr>
                                <tr>
                                    <td class="br extra-small-text" style="width:31.53%; color:transparent;"><label
                                            for="">Routing and Destination</label></td>
                                </tr>
                                <tr>
                                    <td class="br"><input type="text" name="airportTo"
                                            value="{{ old('airportTo', $neffa->airportTo) }}" /></td>
                                    <td class="br" colspan="2">
                                        <input type="text" name="carrierRouting"
                                            value="{{ old('carrierRouting', $neffa->carrierRouting) }}" />
                                    </td>
                                    <td class="br"><input type="text" name="carrierTo"
                                            value="{{ old('carrierTo', $neffa->carrierTo) }}" /></td>
                                    <td class="br"><input type="text" name="carrierBy"
                                            value="{{ old('carrierBy', $neffa->carrierBy) }}" /></td>
                                    <td class="br"><input type="text" name="carrierTo2"
                                            value="{{ old('carrierTo2', $neffa->carrierTo2) }}" /></td>
                                    <td class=""><input type="text" name="carrierBy2"
                                            value="{{ old('carrierBy2', $neffa->carrierBy2) }}" /></td>
                                </tr>
                            </table>
                            <table style="width: 100%;">
                                <tr>
                                    <td class="w-50 br text-center">
                                        <label for="">Airport of Destination</label>
                                    </td>
                                    <td class="w-25 br bb extra-small-text text-center" colspan="2">
                                        <label for="">Requested Flight/Date</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 br">
                                        <input type="text" name="airportDestination"
                                            value="{{ old('airportDestination', $neffa->airportDestination) }}" />
                                    </td>
                                    <td class="w-25 br">
                                        <input type="text" name="requestedFlight"
                                            value="{{ old('requestedFlight', $neffa->requestedFlight) }}" />
                                    </td>
                                    <td class="w-25 br">
                                        <input type="text" name="requestedDate"
                                            value="{{ old('requestedDate', $neffa->requestedDate) }}" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6-2">
                            <table style="width: 100%;border-left: none;">
                                <tr>
                                    <td class="br" rowspan="2" style="width:10.31%"><label
                                            for="">Currency</label></td>
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
                                    <td class="br text-center extra-small-text" style="width:5.155%"><label
                                            for="">PPD</label></td>
                                    <td class="br text-center extra-small-text" style="width:5.155%"><label
                                            for="">COLL</label></td>
                                    <td class="br text-center extra-small-text" style="width:5.155%"><label
                                            for="">PPD</label></td>
                                    <td class="br text-center extra-small-text" style="width:5.155%"><label
                                            for="">COLL</label></td>
                                </tr>
                                <tr>
                                    <td class="br"><input type="text" name="currency"
                                            value="{{ old('currency', $neffa->currency) }}" /></td>
                                    <td class="br"><input type="text" name="code"
                                            value="{{ old('code', $neffa->code) }}" /></td>
                                    <td class="br"><input type="text" name="valppd"
                                            value="{{ old('valppd', $neffa->valppd) }}" /></td>
                                    <td class="br"><input type="text" name="valcoll"
                                            value="{{ old('valcoll', $neffa->valcoll) }}" /></td>
                                    <td class="br"><input type="text" name="otherppd"
                                            value="{{ old('otherppd', $neffa->otherppd) }}" /></td>
                                    <td class="br"><input type="text" name="othercoll"
                                            value="{{ old('othercoll', $neffa->othercoll) }}" /></td>
                                    <td class="br"><input type="text" name="carriageValue"
                                            value="{{ old('carriageValue', $neffa->carriageValue) }}" /></td>
                                    <td class="br"><input type="text" name="customerValue"
                                            value="{{ old('customerValue', $neffa->customerValue) }}" /></td>
                                </tr>
                            </table>
                            <table style="width: 100%;">
                                <tr>
                                    <td class="br text-center" style="width: 28.865%;">
                                        <label for="">Amount of Insurance</label>
                                    </td>
                                    <td class="br" rowspan="2" style="width: 71.135%;">
                                        <p>
                                            <span>INSURANCE-</span>If Carrier offers insurance, and such
                                            insurance is requested in accoudance with the condition
                                            therof,indecate amount to be insured in figures in box marked
                                            "Amount of insurance"
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-25 br">
                                        <input type="text" name="insuranceAmount"
                                            value="{{ old('insuranceAmount', $neffa->insuranceAmount) }}" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <table id="part3">
                        <tr>
                            <td rowspan="2" style="width: 84.12%">
                                <label for="">Handling Information</label>
                                <textarea name="handilingInformation"> {!! old('handilingInformation', $neffa->handilingInformation) !!}</textarea>
                            </td>
                            <td style="padding: 10px; width: 15%"></td>
                        </tr>
                        <tr>
                            <td class="bt bl text-center" style="width: 15.88%">
                                <label for="">SCI</label> <input type="text" name="sci"
                                    value="{{ old('sci', $neffa->sci) }}" />
                            </td>
                        </tr>
                    </table>
                    <table id="part4">
                        <tr>
                            <td rowspan="2" class="text-center bb br" style="vertical-align: middle;width: 5.29%;"><label
                                    for="">No. of<br> Pieces<br>RCP</label></td>
                            <td rowspan="2" class="text-center bb br" style="vertical-align: middle;width: 9.52%;"><label
                                    for="">Gross<br> Weight</label></td>
                            <td rowspan="2" class="text-center bb br" style="vertical-align: middle;width: 1.322%;"><label
                                    for="">kg<br> lb</label></td>
                            <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                            <td colspan="2" class="br" style="width: 10.852%;">Rate Class</td>
                            <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                            <td rowspan="2" class="text-center br bb" style="vertical-align: middle;width: 9.53%;"><label
                                    for="">Chargeable<br>Weight</label></td>
                            <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                            <td rowspan="2" class="text-center br bb" style="vertical-align: middle;width: 10.85%;"><label
                                    for="">Rate<br>Charge</label></td>
                            <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                            <td rowspan="2" class="text-center br bb" style="vertical-align: middle;width: 16.40%;"><label
                                    for="">Total</label></td>
                            <td rowspan="2" class="text-center br space" style="width: 1.322%;"></td>
                            <td rowspan="2" class="text-center br bb" style="vertical-align: middle;width: 29.63%;"><label
                                    for="">Nature and Quantity of Goods<br>(incl. Dimensions of Volume)</label></td>
                        </tr>
                        <tr>
                            <td class="space-nobg br" style="width: 1.322%;"></td>
                            <td colspan="2" class="bt bb br" style="width: 9.53%;"><label for="">Commodity<br>Item
                                    No.</label></td>
                        </tr>
                        <tr id="item1" style="position: relative">
                            <div class="notify-horizontal" style="position: absolute;top:56%;left:6%;width:60%;z-index:99;">
                                <textarea style="color: #000;font-size:9pt;  font-family: 'Roboto', sans-serif;background:transparent;resize: unset;"></textarea>
                            </div>
                            <td class="br" style="height: 193px;"><textarea for="" name="piecesNumber"
                                    style="height:190px;">{!! old('piecesNumber', $neffa->piecesNumber) !!}</textarea></td>
                            <td class="br"><textarea for="" style="height:190px;"
                                    name="grossWeight">{{ old('grossWeight', $neffa->grossWeight) }}</textarea></td>
                            <td class="br td-nop"><textarea for="" style="height:190px;"
                                    name="kg">{{ old('kg', $neffa->kg) }}</textarea></td>
                            <td class="space br"></td>
                            <td class="br"><textarea for="" style="height:190px;"
                                    name="rateClass">{{ old('rateClass', $neffa->rateClass) }}</textarea></td>
                            <td class="br"><textarea for="" style="height:190px;"
                                    name="commodity">{{ old('commodity', $neffa->commodity) }}</textarea></td>
                            <td class="space br"></td>
                            <td class="br"><textarea for="" style="height:190px;"
                                    name="chargeableWeight">{{ old('chargeableWeight', $neffa->chargeableWeight) }}</textarea>
                            </td>
                            <td class="space br"></td>
                            <td class="br"><textarea for="" style="height:190px;"
                                    name="rate">{{ old('rate', $neffa->rate) }}</textarea></td>
                            <td class="space br"></td>
                            <td class="br"><textarea for="" style="height:190px;"
                                    name="total">{{ old('total', $neffa->total) }}</textarea></td>
                            <td class="space br"></td>
                            <td class="br"><textarea for="" style="height:190px;"
                                    name="nature">{{ old('nature', $neffa->nature) }}</textarea></td>
                        </tr>
                        <tr id="item-total">
                            <td class="bt br"><input type="text" name="wholeTotal[]"
                                    value="{{ optional($neffa->wholeTotal)[0] }}"></td>
                            <td class="bt br"><input type="text" name="wholeTotal[]"
                                    value="{{ optional($neffa->wholeTotal)[1] }}"></td>
                            <td class="space-nobg br"></td>
                            <td class="space br"></td>
                            <td class="space-nobg br"></td>
                            <td class="space-nobg br"></td>
                            <td class="space br"></td>
                            <td class="space-nobg br"></td>
                            <td class="space br"></td>
                            <td class="space-nobg br"></td>
                            <td class="space br"></td>
                            <td class="bt br"><input type="text" name="wholeTotal[]"
                                    value="{{ optional($neffa->wholeTotal)[2] }}"></td>
                            <td class="space br"></td>
                            <td class="space-nobg br" style="vertical-align: middle;"><input type="text"
                                    style="padding-left:10px;" name="wholeTotal[]"
                                    value="{{ optional($neffa->wholeTotal)[3] }}"></td>
                        </tr>
                    </table>

                    <table id="part5">
                        <tr>
                            <td style="width: 38.1%" class="text-center bb br" colspan="2">
                                <label for="">Weight Charge</label>
                            </td>
                            <td rowspan="6" colspan="3" class="bl">
                                <label for="">Other Charges</label> <textarea for="" rows="7"
                                    name="otherCharge">{{ old('otherCharge', optional($neffa->information)['otherCharge']) }}</textarea>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="br"><input type="text" name="prepaidWeightCharge"
                                    value="{{ old('prepaidWeightCharge', $neffa->prepaidWeightCharge) }}" /></td>
                            <td style="width: 19.05%"><input type="text" name="collectWeightCharge"
                                    value="{{ old('collectWeightCharge', $neffa->collectWeightCharge) }}" /></td>
                        </tr>
                        <tr>
                            <td style="width: 38.1%" class="text-center bb br bt" colspan="2">
                                <label for="">Valuation Charge</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="br"><input type="text"
                                    name="prepaidValuationCharge"
                                    value="{{ old('prepaidValuationCharge', $neffa->prepaidValuationCharge) }}" /></td>
                            <td style="width: 19.05%"><input type="text" name="collectValuationCharge"
                                    value="{{ old('collectValuationCharge', $neffa->collectValuationCharge) }}" /></td>
                        </tr>
                        <tr>
                            <td style="width: 38.1%" class="text-center bb br bt" colspan="2">
                                <label for="">Tax</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="br"><input name="prepaidTax"
                                    value="{{ old('prepaidTax', $neffa->prepaidTax) }}" /></td>
                            <td style="width: 19.05%"><input name="collectTax"
                                    value="{{ old('collectTax', $neffa->collectTax) }}" /></td>
                        </tr>
                        <tr>
                            <td style="width: 38.1%" class="text-center bb br bt" colspan="2">
                                <label for="">Total Other Charges Due Agent</label>
                            </td>
                            <td rowspan="2" colspan="3" class="bl bt">
                                <p>
                                    <span>
                                        Shipper certifes that the particular on the face hereof are
                                        correct and that
                                    </span>
                                    insofar asw any part of the copnsignment contents dangerous goods,
                                    such part is properly described by name and is in proper condition
                                    for carriage by air according to the applicable Dengerous Goods
                                    Regulations.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="br"><input type="text" name="prepaidDueAgent"
                                    value="{{ old('prepaidDueAgent', $neffa->prepaidDueAgent) }}" /></td>
                            <td style="width: 19.05%"><input type="text" name="collectDueAgent"
                                    value="{{ old('collectDueAgent', $neffa->collectDueAgent) }}" /></td>
                        </tr>
                        <tr>
                            <td style="width: 38.1%" class="text-center bb br bt" colspan="2">
                                <label for="">Total Other Charges Due Carrier</label>
                            </td>
                            <td rowspan="2" colspan="3">
                               
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="br"><input type="text" name="prepaidDueCarrier"
                                    value="{{ old('prepaidDueCarrier', $neffa->prepaidDueCarrier) }}" /></td>
                            <td style="width: 19.05%" class="br bl"><input type="text" name="collectDueCarrier"
                                    value="{{ old('collectDueCarrier', $neffa->collectDueCarrier) }}" /></td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%;height:24px;" class="text-center br space"></td>
                            <td style="width: 19.05%;height:24px;" class="text-center br space"></td>
                            <td colspan="3" style="border-bottom: 1px dotted black;"> <input type="text"
                                style="text-align: center;width:100%;" name="agent"
                               value=" {{ optional($neffa->information)['agent'] }}"></td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%;" class="br space"></td>
                            <td style="width: 19.05%;" class="bl br space"></td>
                           
                            <td class="bb text-center" colspan="3"><label for="">Signature of Shipper or his Agent</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="text-center bb br bt">
                                <label for="">Total Prepaid</label>
                            </td>
                            <td style="width: 19.05%" class="text-center bb br bt">
                                <label for="">Total Collect</label>
                            </td>
                            <td style="border-bottom: 1px dotted black;" rowspan="3" colspan="3" class="bl bt">
                                <textarea for="" rows="3"
                                    name="carrierAgent">{{ optional($neffa->information)['carrierAgent'] }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="br"><input type="text" name="totalPrepaid"
                                    value="{{ old('totalPrepaid', $neffa->totalPrepaid) }}" /></td>
                            <td style="width: 19.05%"><input type="text" name="totalCollect"
                                    value="{{ old('totalCollect', $neffa->totalCollect) }}" /></td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="text-center bb br bt">
                                <label for="">Currency Conversion Rates</label>
                            </td>
                            <td style="width: 19.05%" class="text-center bb br bt">
                                <label for="">CC Charges in Dest. Currency</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="br"><input type="text" name="currencyConversion"
                                    value="{{ old('currencyConversion', $neffa->currencyConversion) }}" /></td>
                            <td style="width: 19.05%" class="br"><input type="text" name="ccDestinationCharge"
                                    value="{{ old('ccDestinationCharge', $neffa->ccDestinationCharge) }}" /></td>
                            <td style="width: 20.22%"><label for="">Executed on (date)</label></td>
                            <td style="width: 19.05%"><label for="">at (place)</label></td>
                            <td style="width: 22.63%;text-align: right;vertical-align: bottom;"><label for="">Signature of
                                    issuing Carrier ot its Agent</td>
                        </tr>

                    </table>
                    <table id="part6">
                        <tr>
                            <td style="width: 19.05%;vertical-align: middle;" colspan="2" rowspan="2"
                                class="text-center br bb"><label for="">For Carrier's Use only<br> at Destination</label>
                            </td>
                            <td style="width: 19.05%" class="br bb text-center"><label for="">Charges at
                                    Destination</label></td>
                            <td style="width: 19.05%" class=" br bb text-center"><label for="">Total Collect
                                    Charges</label></td>
                            <td style="width: 42.85%" class="text-center"></td>
                        </tr>
                        <tr>
                            <td style="width: 19.05%" class="br bb"><input type="text" name="destinationCharge"
                                    value="{{ old('destinationCharge', $neffa->destinationCharge) }}"></td>
                            <td style="width: 19.05%" class="br bb"><input type="text" name="totalCollectCharge"
                                    value="{{ old('totalCollectCharge', $neffa->totalCollectCharge) }}"></td>
                            <td style="width: 42.85%"><input type="text" style="text-align: right;" name="bottomCode"
                                    value="{{ $neffa->bottomCode }}"></td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="form-group d-flex m-2">
                            {!! Form::submit('submit', ['class' => 'global-btn mr-2']) !!}
                            <button class='global-btn' type="reset">Reset</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </section>
@endsection
