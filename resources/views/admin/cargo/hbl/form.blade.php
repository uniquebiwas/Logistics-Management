@extends('layouts.admin')
@section('title', 'House Bill of Lading')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/cargo.css') }}">
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="text-transform: uppercase;">House Bill of Lading</h3>
                    <div class="card-tools">
                        <a href="{{ route('hbl.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="card-body">
                        @if ($hbl->id)
                            {!! Form::open(['url' => route('hbl.update', ['hbl' => $hbl->id])]) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['url' => route('hbl.store', ['type' => request()->type])]) !!}
                        @endif
                        <div class="form-input-page">
                            <div class="container-fluid">
                                <div class="form-cover form-cover1">
                                        <div class="form-part1">
                                            <div class="row m-0">
                                                <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                                    <div class="part1-left">
                                                        <div class="form-group"
                                                            style="height: 94px;border-bottom: 1px solid #000;padding:5px">
                                                            <label for="">Shipper's Name and Address:</label>
                                                            <textarea class="form-control" name="shipper"
                                                                style="height: 60px;">{{ old('shipper', $hbl->shipper) }}</textarea>
                                                        </div>
                                                        <div class="form-group"
                                                            style="height: 94px;border-bottom: 1px solid #000;padding:5px">
                                                            <label for="">Consignee Name and Address:</label>
                                                            <textarea class="form-control" name="consignee"
                                                                style="height: 60px;">{{ old('consignee', $hbl->consignee) }}</textarea>
                                                        </div>
                                                        <div class="form-group m-0"
                                                            style="height: 94px;border-bottom: 1px solid #000;padding:5px">
                                                            <label for="">Notify:</label>
                                                            <textarea class="form-control" name="notify"
                                                                style="height: 60px;">{{ old('notify', $hbl->notify) }}</textarea>
                                                        </div>
                                                        <div class="row m-0" style="border-bottom: 1px solid #000;">
                                                            <div class="col-md-6 p-0"
                                                                style="border-right: 1px solid #000;">
                                                                <div class="form-group"
                                                                    style="height: 42px;padding:5px">
                                                                    <label for="">Pre Carriage by:</label>
                                                                    <input type="text"
                                                                        value="{{ old('preCarriageBy', $hbl->preCarriageBy) }}"
                                                                        class="form-control" name="preCarriageBy"
                                                                        style="height: 18px;">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 p-0">
                                                                <div class="form-group"
                                                                    style="height: 42px;padding:5px">
                                                                    <label for="">Mode Means of Transport:</label>
                                                                    <input type="text"
                                                                        value="{{ old('transportMode', $hbl->transportMode) }}"
                                                                        class="form-control" name="transportMode"
                                                                        style="height: 18px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-0" style="border-bottom: 1px solid #000;">
                                                            <div class="col-md-6 p-0"
                                                                style="border-right: 1px solid #000;">
                                                                <div class="form-group"
                                                                    style="height: 42px;padding:5px">
                                                                    <label for="">Place of Receipt:</label>
                                                                    <input type="text"
                                                                        value="{{ old('placeOfReceipt', $hbl->placeOfReceipt) }}"
                                                                        class="form-control" name="placeOfReceipt"
                                                                        style="height: 18px;">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 p-0">
                                                                <div class="form-group"
                                                                    style="height: 42px;padding:5px">
                                                                    <label for="">Port of Loading:</label>
                                                                    <input type="text"
                                                                        value="{{ old('portOfLoading', $hbl->portOfLoading) }}"
                                                                        class="form-control" name="portOfLoading"
                                                                        style="height: 18px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-0" style="border-bottom: 1px solid #000;">
                                                            <div class="col-md-6 p-0"
                                                                style="border-right: 1px solid #000;">
                                                                <div class="form-group"
                                                                    style="height: 42px;padding:5px">
                                                                    <label for="">Port of Discharge:</label>
                                                                    <input type="text"
                                                                        value="{{ old('portOfDischarge', $hbl->portOfDischarge) }}"
                                                                        class="form-control" name="portOfDischarge"
                                                                        style="height: 18px;">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 p-0">
                                                                <div class="form-group"
                                                                    style="height: 42px;padding:5px">
                                                                    <label for="">Port of Delivery:</label>
                                                                    <input type="text"
                                                                        value="{{ old('portOfDelivery', $hbl->portOfDelivery) }}"
                                                                        class="form-control" name="portOfDelivery"
                                                                        style="height: 18px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-0">
                                                            <div class="col-md-12 p-0">
                                                                <div class="form-group"
                                                                    style="height: 42px;padding:5px">
                                                                    <label for="">Vessel Voy. No:</label>
                                                                    <input type="text"
                                                                        value="{{ old('vesselVoyNumber', $hbl->vesselVoyNumber) }}"
                                                                        class="form-control" name="vesselVoyNumber"
                                                                        style="height: 18px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-0">
                                                    <div class="part1-right1">
                                                        <div class="row m-0">
                                                            <div class="col-md-6 p-0">
                                                                <label>HBL No.:</label>
                                                            </div>
                                                            <div class="col-md-6 p-0">
                                                                <input type="text"
                                                                    value="{{ old('hblNumber', $hbl->hblNumber) }}"
                                                                    class="form-control" name="hblNumber"
                                                                    style="border: 1px solid #000;border-radius:0;border-bottom:none;padding:5px 5px;">
                                                            </div>
                                                        </div>
                                                        <div class="row m-0">
                                                            <div class="col-md-6 p-0">
                                                                <label>Shipment Reference No.:</label>
                                                            </div>
                                                            <div class="col-md-6 p-0">
                                                                <input type="text"
                                                                    value="{{ old('shipmentReferenceNumber', $hbl->shipmentReferenceNumber) }}"
                                                                    class="form-control" name="shipmentReferenceNumber"
                                                                    style="border: 1px solid #000;border-radius:0;padding:5px 5px;">
                                                            </div>
                                                        </div>
                                                        <div class="hbl-logo">
                                                            <a href="#"><img src="{{ asset('front/img/logo.png') }}"
                                                                    alt="images"></a>
                                                        </div>
                                                        <p
                                                            style="font-size:11px;line-height: 15px;color:#000;margin-top:15px;">
                                                            The shipment is taken in apparent good order and condition,
                                                            herein at the place of receipt,
                                                            and assumes the responsibility for transport and delivery by
                                                            ocean vessel to the port of
                                                            discharge or place of delivery, as mentioned. The contents,
                                                            weight, value and measurement
                                                            included are according to Shipper’s declaration. This House Bill
                                                            of Lading shall have effect
                                                            subject to our shipping/trading conditions. The goods to be
                                                            delivered at the mentioned port
                                                            of discharge or place of delivery, whichever is applicable,
                                                            subject always to the exceptions,
                                                            limitations, conditions and liberties set out by the Terms and
                                                            Conditions of Carriage of the
                                                            corresponding Master Bill of Lading, to which the Shipper and/or
                                                            Consignee agree to accepting
                                                            this Bill of Lading.
                                                        </p>
                                                        <p style="font-size:11px;line-height: 15px;color:#000;">
                                                            In witness whereof original House Bill of Lading have been duly
                                                            endorsed not otherwise stated
                                                            above, one copy of which being accomplished the others shall be
                                                            void.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-part3 form3-part3">
                                            <table width="100%" style="border-top:none;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:94px;">Container No.(s)</th>
                                                        <th style="width:132px;">Marks and Numbers</th>
                                                        <th style="width:223px;">Number of packages, kind of packages,
                                                            general description of goods</th>
                                                        <th style="width:113px;">Gross Weight</th>
                                                        <th style="width:113px;">Measurement</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width:94px;"><textarea class="form-control"
                                                                name="containerNo">{{ old('containerNo', $hbl->containerNo) }}</textarea>
                                                        </td>
                                                        <td style="width:132px;"><textarea class="form-control"
                                                                name="marksAndNumbers">{{ old('marksAndNumbers', $hbl->marksAndNumbers) }}</textarea>
                                                        </td>
                                                        <td style="width:223px;"><textarea class="form-control"
                                                                name="description">{{ old('description', $hbl->description) }}</textarea>
                                                        </td>
                                                        <td style="width:113px;"><textarea class="form-control"
                                                                name="grossWeight">{{ old('grossWeight', $hbl->grossWeight) }}</textarea>
                                                        </td>
                                                        <td style="width:113px;"><textarea class="form-control"
                                                                name="measurement">{{ old('measurement', $hbl->measurement) }}</textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="hbl-part1">
                                            <div class="row m-0" style="border-top: 1px solid #000;">
                                                <div class="col-md-3 p-0" style="border-right: 1px solid #000;">
                                                    <div class="form-group" style="height: 42px;padding:5px">
                                                        <label for="">Freight Amount</label>
                                                        <input type="text"
                                                            value="{{ old('freightAmount', $hbl->freightAmount) }}"
                                                            class="form-control" name="freightAmount"
                                                            style="height: 18px;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 p-0" style="border-right: 1px solid #000;">
                                                    <div class="form-group" style="height: 42px;padding:5px">
                                                        <label for="">Freight Payable at</label>
                                                        <input type="text"
                                                            value="{{ old('freightPayable', $hbl->freightPayable) }}"
                                                            class="form-control" name="freightPayable"
                                                            style="height: 18px;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 p-0" style="border-right: 1px solid #000;">
                                                    <div class="form-group" style="height: 42px;padding:5px">
                                                        <label for="">Number of Original HBL</label>
                                                        <input type="text"
                                                            value="{{ old('numberOfOriginalHbl', $hbl->numberOfOriginalHbl) }}"
                                                            class="form-control" name="numberOfOriginalHbl"
                                                            style="height: 18px;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <div class="form-group" style="height: 42px;padding:5px">
                                                        <label for="">Place and Date of Issue</label>
                                                        <input type="text" value="{{ old('issueDate', $hbl->issueDate) }}"
                                                            class="form-control" name="issueDate" style="height: 18px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hbl-part1">
                                            <div class="row m-0" style="border-top: 1px solid #000;">
                                                <div class="col-md-6 p-0" style="border-right: 1px solid #000;">
                                                    <div class="form-group" style="height: 94px;padding:5px">
                                                        <label for="">Other Particulars: (If any)</label>
                                                        <textarea class="form-control" name="others"
                                                            style="height: 50px;">{{ old('others', $hbl->others) }}</textarea>
                                                        <p style="font-size:13px;color:#000;">Weight and measurement of
                                                            container not to be included</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-0">
                                                    <div class="form-group" style="height: 94px;padding:5px">
                                                        <label for="">&nbsp;</label>
                                                        <textarea class="form-control" name="lastPart"
                                                            style="height: 65px;">{{ old('lastPart', $hbl->lastPart) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 p-0" style="border-top:1px solid #000;">
                                                    <div class="form-group" style="height: 80px;padding:5px">
                                                        <label for="">Remarks:</label>
                                                        <textarea class="form-control" name="amountInWords"
                                                            style="height: 50px;">{{ old('amountInWords', $hbl->amountInWords) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <p style="color:#000;background: #f5f8ff;
                                        max-width: 850px;
                                        font-size: 13px;
                                        margin:auto;
                                        text-align:center;
                                        height: auto;">Air Logistics Group Pvt. Ltd. GPO Box No.: 24884, Kathmandu, Nepal
                                    Phone: +977-1-4004795, Email:cs@airlogisticsgroup.com.np</p>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group offset-1  col-6 ">
                                {!! Form::submit('submit', ['class' => 'global-btn']) !!}
                                <button class='global-btn' type="reset">Reset</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
