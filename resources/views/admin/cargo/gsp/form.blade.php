@extends('layouts.admin')
@section('title', 'GSP')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/cargo.css') }}">
@endpush
@section('content')
    <section class="content-header pt-0">
        <pre >Sample pre</pre>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Generalized System Of Perferences</h3>
                    <div class="card-tools">
                        <a href="{{ route('ncc.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="card-body">
                        @if ($gsp->id)
                        {!! Form::open(['url' => route('gsp.update', ['gsp' => $gsp->id])]) !!}
                        @method('PATCH')
                    @else
                        {!! Form::open(['url' => route('gsp.store', ['type' => request()->type])]) !!}
                    @endif
                    <div class="form-input-page">
                        <div class="container-fluid">
                            <div class="form-cover">
                                    <div class="form-part1">
                                        <div class="row m-0">
                                            <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                                <div class="part1-left">
                                                    <div class="form-group"
                                                        style="height: 96px;border-bottom: 1px solid #000;padding:10px 10px;">
                                                        <label for="">1. Goods consigned from (exporter's business name, address,
                                                            country)</label>
                                                        <textarea name="exporter_details" class="form-control" style="height: 50px;">{{ $gsp->exporter_details }}</textarea>
                                                    </div>
                                                    <div class="form-group" style="height: 96px;padding:10px 10px;">
                                                        <label for="">2. Goods consigned to (Consignee's name, address, country)</label>
                                                        <textarea name="consignee_details" class="form-control" style="height: 50px;">{{ $gsp->consignee_details }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 p-0">
                                                <div class="part1-right">
                                                    <span>Reference No. <b
                                                            style="font-size: 15px;letter-spacing:2px;">123456</b></span>
                                                    <div class="part1-right-text">
                                                        <p
                                                            style="text-transform: uppercase;font-size:11px;font-weight:600;margin-top:10px;line-height:1.2;">
                                                            Generalized System of Preferences</p>
                                                        <p style="text-transform: uppercase;font-size:11px;font-weight:600;">Certificate
                                                            of Origin</p>
                                                        <b style="font-size:12px;font-weight:600;">(Combined declaration and
                                                            certificate)</b>
                                                        <b
                                                            style="display: block;text-transform:uppercase;font-weight:bold;font-size:12px;margin-top:5px;">Form
                                                            A</b>
                                                        <p style="display: flex;
                                                        margin-top:11px;
                                                        align-items: center;
                                                        white-space: nowrap;
                                                        justify-content: center;
                                                        font-size: 13px;">issued in <input type="text" placeholder="KTM"
                                                                class="form-control" style="width: 140px;
                                                            text-align: center;
                                                            border-bottom: 1px dotted #000;
                                                            border-radius: 0;
                                                            padding-bottom: 0;
                                                            padding-top: 0;
                                                            font-size: 13px;
                                                            font-weight: bold;" name="issued_address" value="{{ $gsp->issued_address }}">/ Nepal</p>
                                                        <span>(Coyntry)</span>
                                                        <b style="display: block;text-align:right;font-weight:normal;margin-top:10px;">See notes
                                                            overleaf</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-part2">
                                        <div class="row m-0">
                                            <div class="col-md-6 p-0" style="border-right:1px solid #000;height:179px;">
                                                <div class="form-group" style="padding:10px 10px;">
                                                    <label for="">3. Means of transport and route (as far as known)</label>
                                                    <textarea name="transport" class="form-control" style="height: 140px;">{{ $gsp->transport }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 p-0">
                                                <div class="form-group" style="padding:10px 10px;height:179px;">
                                                    <label for="">4. For official use</label>
                                                    <textarea name="official_use" class="form-control" style="height: 140px;">{{ $gsp->official_use }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-part3">
                                        <table width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:35px;">5. Item number</th>
                                                    <th style="width:87px;">6. Marks and numbers of packages</th>
                                                    <th style="width:302px;">7. Number and kind of packages; description of goods</th>
                                                    <th style="width:87px;">8. Origin criterion (see notes overleaf)</th>
                                                    <th style="width:87px;">9. Gross weight or other quantity</th>
                                                    <th style="width:87px;">10. Number and date of invoices</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width:35px;"><textarea name="item_no" class="form-control">{{ $gsp->item_no }}</textarea></td>
                                                    <td style="width:87px;"><textarea name="package_marks" class="form-control">{{ $gsp->package_marks }}</textarea></td>
                                                    <td style="width:302px;"><textarea name="description_of_goods" class="form-control">{{ $gsp->description_of_goods }}</textarea></td>
                                                    <td style="width:87px;"><textarea name="origin" class="form-control">{{ $gsp->origin }}</textarea></td>
                                                    <td style="width:87px;"><textarea name="gross_weight" class="form-control">{{ $gsp->gross_weight }}</textarea></td>
                                                    <td style="width:87px;"><textarea name="invoice_data" class="form-control">{{ $gsp->invoice_data }}</textarea></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-part4">
                                        <div class="row m-0">
                                            <div class="col-md-6 p-0" style="border-right:1px solid #000;">
                                                <div class="form-part4-left">
                                                    <label for="" style="font-weight: 600;font-size:13px;">11. Certification</label>
                                                    <p style="padding-left:22px;height: 153px;">
                                                        It is hereby certified, on the basic of control carried out, that the
                                                        declaration by the exporter is correct.
                                                    </p>
                                                    <p>
                                                        <input type="text" class="form-control" style="border-bottom:1px dotted #000;padding-top:0;padding-bottom:0;border-radius:0;">
                                                        <span style="font-size:11px;">place and date, signature and stamp of certifying authority</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 p-0">
                                                <div class="form-part4-right">
                                                    <label for="" style="font-weight: 600;font-size:13px;">12. Declaration by the exporter</label>
                                                    <p style="padding-left:22px;">
                                                        The undersigned hereby declares that the above details and statements are
                                                        correct;
                                                        that all the goods were
                                                        <b style="display: flex;
                                                        white-space: nowrap;margin-top: 10px;">procuded in <input type="text" class="form-control" style="border-bottom: 1px dotted #000;
                                                            border-radius: 0;
                                                            padding-top: 0;
                                                            padding-bottom: 0;text-align:center;"
                                                            name="produced_country" value="{{ $gsp->produced_country }}"></b>
                                                        <span style="display: block;text-align:center;margin-bottom:10px;font-size:11px;">(country)</span>
                                                        and that they comply with the origin requirements specified for those goods in
                                                        the
                                                        generalized system of preferences for goods exported to
                                                        <span><input type="text" class="form-control" style="border-bottom:1px dotted #000;padding-top:0;padding-bottom:0;border-radius:0;text-align:center;"  name='importing_country' value="{{ $gsp->importing_country }}"> <span style="display: block;text-align:center;font-size:11px;">(importing
                                                                country)</span></span>
                                                    </p>
                                                    <p style="margin-bottom:0;">
                                                        <input type="text" class="form-control" style="border-bottom:1px dotted #000;padding-top:0;padding-bottom:0;border-radius:0;" name="export_date"  value="{{ $gsp->export_date }}">
                                                        <span style="font-size:11px;">place and date, signature of authorized signatory</span>
                                                    </p>
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
