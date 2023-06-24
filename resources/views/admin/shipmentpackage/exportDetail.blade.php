@extends('layouts.admin')
@section('title', 'Export Detail')

@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ UcWords($export_info->title) . ' Detail' }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('export.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>

                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-striped table-hover" id="table1"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>

                                <th>HWAB</th>
                                <th>Sender</th>
                                <th>Consignee</th>
                                <th>Pcs</th>
                                <th>Weight (KGs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shipmentPackage_info as $key => $value)
                                <tr>

                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->barcode }} ({{ @$value->package_status }})</td>
                                    <td> {{ @$value->senderName }} </td>
                                    <td> {{ @$value->receiverCompany }} </td>
                                    <td>{{ @$value->totalPiece }}</td>
                                    <td>{{ @$value->total_weight }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
@endsection
