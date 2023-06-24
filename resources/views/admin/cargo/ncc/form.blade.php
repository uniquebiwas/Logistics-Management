@extends('layouts.admin')
@section('title', 'ncc')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/cargo.css') }}">
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nepal Camber Of Commerce FORM</h3>
                    <div class="card-tools">
                        <a href="{{ route('ncc.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="card-body">

                        <div class="form-input-page">
                            <div class="container-fluid">
                                <div class="form-cover form-cover1">
                                    @if ($ncc->id)
                                        {!! Form::open(['url' => route('ncc.update', ['ncc' => $ncc->id])]) !!}
                                        @method('PATCH')
                                    @else
                                        {!! Form::open(['url' => route('ncc.store', ['type' => request()->type])]) !!}
                                    @endif
                                    <div class="form-part1">
                                        <div class="row m-0">
                                            <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                                <div class="part1-left">
                                                    <div class="form-group"
                                                        style="height: 163px;border-bottom: 1px solid #000;padding:10px 10px;">
                                                        <label for="">1. Exporter's name & address</label>
                                                        <textarea name="exporter_details" class="form-control"
                                                            style="height: 55px;">{{ $ncc->exporter_details }}</textarea>
                                                        <ul class="lists">
                                                            <li>
                                                                <label for="">Tax Registeration No. & Place :</label>
                                                                <input type="text" class="form-control"
                                                                    name="exporter_registration_no"
                                                                    value="{{ $ncc->exporter_registration_no }}">
                                                            </li>
                                                            <li>
                                                                <label for="">Firm Registeration No. :</label>
                                                                <input type="text" class="form-control"
                                                                    name="firm_registration_no"
                                                                    value="{{ $ncc->firm_registration_no }}">
                                                            </li>
                                                            <li>
                                                                <label for="">(Place and Date) :</label>
                                                                <input type="text" class="form-control"
                                                                    name="place_and_data"
                                                                    value="{{ $ncc->place_and_data }}">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="form-group" style="height: 143px;padding:10px 10px;">
                                                        <label for="">2. Consignee's name, address, country</label>
                                                        <textarea name="consignee_details" class="form-control"
                                                            style="height: 105px;">{{ $ncc->consignee_details }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 p-0">
                                                <div class="part1-right1">
                                                    <span>NCC Reference No. <b
                                                            style="font-size: 15px;letter-spacing:2px;">123456</b></span>
                                                    <div class="part1-right-text">
                                                        <p
                                                            style="text-transform: uppercase;font-size:17px;font-weight:600;margin-top:8px;">
                                                            Certificate
                                                            of Origin
                                                        </p>
                                                        <p style="font-size:12px;margin-top:-5px;">Issued by:</p>
                                                        <img src="{{ asset('front/img/ncc.png') }}" alt="images" style="height: 75px;
                                                                            width: 75px;margin:3px 0;">
                                                        <p
                                                            style="text-transform: uppercase;font-size:17px;font-weight:600;margin-top:8px;line-height:1.2;">
                                                            Nepal Chamber of Commerce
                                                        </p>
                                                        <p style="font-size:13px;line-height:20px;margin-top:3px;">
                                                            Chamber Bhawan, Kantipath <br>
                                                            P.O.Box No. 198, Kathmandu, Nepal <br>
                                                            Tel.: +977-1-4230947 <br>
                                                            Fax: 00977-1-4229998 <br>
                                                            E-mail: info@nepalchamber.org
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-part2">
                                        <div class="row m-0">
                                            <div class="col-md-6 p-0" style="border-right:1px solid #000;height:64px;">
                                                <div class="form-group" style="padding:10px 10px;">
                                                    <label for="">3. Means of transport and route</label>
                                                    <textarea name="transport" class="form-control"
                                                        style="height: 30px;">{{ $ncc->transport }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 p-0">
                                                <div class="form-group" style="padding:10px 10px;height:64px;">
                                                    <label for="">4. Export Licence No. & Date (When Needed)</label>
                                                    <textarea name="license_no" class="form-control"
                                                        style="height: 30px;">{{ $ncc->license_no }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-part3 form1-part3">
                                        <table width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:91px;">5. Marks and numbers of packages</th>
                                                    <th style="width:272px;">6. Description of goods</th>
                                                    <th style="width:106px;">7. Value <input type="text"  name="currency" value="{{ $ncc->currency }}" style="border:white"></th>
                                                    <th style="width:79px;">8. Quantity <input type="text" name="unit" value="{{ $ncc->unit }}" style="border:white"></th>
                                                    <th style="width:87px;">9. Place of production</th>
                                                    <th style="width:91px;">10. Number and date of invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width:91px;"><textarea name="package_marks"
                                                            class="form-control">{!! $ncc->package_marks !!}</textarea></td>
                                                    <td style="width:272px;"><textarea name="description_of_goods"
                                                            class="form-control">{!! $ncc->description_of_goods !!}</textarea></td>
                                                    <td style="width:106px;"><textarea name="value"
                                                            class="form-control">{!! $ncc->value !!}</textarea></td>
                                                    <td style="width:79px;"><textarea name="quantity"
                                                            class="form-control">{!! $ncc->quantity !!}</textarea></td>
                                                    <td style="width:87px;"><textarea name="production"
                                                            class="form-control">{!! $ncc->production !!}</textarea></td>
                                                    <td style="width:91px;"><textarea name="invoice_data"
                                                            class="form-control">{!! $ncc->invoice_data !!}</textarea></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-part7"
                                        style="border-top:1px solid #000;height:28px;padding:0 10px;">
                                        <ul>
                                            <li>
                                                <label for="" style="margin-right:10px;">Value in Words:</label>
                                                <input type="text" class="form-control" name="value_in_words" value="{{ $ncc->value_in_words }}">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-part4">
                                        <div class="row m-0">
                                            <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                                <div class="form-part4-left form1-part4-left">
                                                    <label for="" style="font-weight: 600;font-size:14px;">11.
                                                        Declaration by the exporter</label>
                                                    <p style="height:55px;">
                                                        The Ubdersigned hereby declares that the above mentioned goods
                                                        have been produced in Nepal and that the details given above are
                                                        true and correct.
                                                    </p>
                                                    <ul class="details">
                                                        <li>
                                                            <label for="">Authorised Signature</label>
                                                            <span>Seal</span>
                                                        </li>
                                                        <li>
                                                            <label for="">Full Name:</label>
                                                            <input type="text" class="form-control"
                                                                name="declaration_name" value="{{ $ncc->declaration_name }}">
                                                        </li>
                                                        <li>
                                                            <label for="">Title:</label>
                                                            <input type="text" class="form-control"
                                                                name="declaration_title" value="{{ $ncc->declaration_title }}">
                                                        </li>
                                                        <li>
                                                            <label for="">Date:</label>
                                                            <input type="text" class="form-control" name="export_date" value=" {{ $ncc->export_date }}">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 p-0">
                                                <div class="form-part4-right form1-part4-right">
                                                    <label for="" style="font-weight: 600;font-size:14px;">12.
                                                        Certification by issuing authority</label>
                                                    <p style="height:55px;">
                                                        It is hereby certified that the above mentioned goods are of
                                                        Neplease Origin to the best of our knpwledge and belief.
                                                    </p>
                                                    <ul class="details">
                                                        <li>
                                                            <label for="">Authorised Signature</label>
                                                            <span>Seal</span>
                                                        </li>
                                                        <li>
                                                            <label for="">Full Name:</label>
                                                            <input type="text" class="form-control">
                                                        </li>
                                                        <li>
                                                            <label for="">Title:</label>
                                                            <input type="text" class="form-control">
                                                        </li>
                                                        <li>
                                                            <label for="">Date:</label>
                                                            <input type="text" class="form-control">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
