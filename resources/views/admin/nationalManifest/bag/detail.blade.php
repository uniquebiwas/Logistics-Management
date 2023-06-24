@extends('layouts.admin')
@section('title', 'National Manifest')

@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-capitalize">{{ $bag->title }} List</h3>
                            <div class="card-tools d-flex">
                                @can('bag-edit')
                                    <a title="edit Bag" id="" class="view-btn"
                                        href=" {{ route('bag.edit', $bag->id) }} ">
                                        <i class="fas fa-edit    "></i>
                                    </a>
                                @endcan

                                @can('bag-delete')
                                    {!! Form::open(['url' => route('bag.destroy', $bag->id), 'onsubmit' => 'return confirm("Are you sure you want to delete this bag?")']) !!}
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="view-btn">
                                        <i class="fas fa-trash    "></i>
                                    </button>
                                    {!! Form::close() !!}
                                @endcan
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Shipment Code</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>Pcs</th>
                                        <th>Weight(KGS)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $shipmentId = 1;
                                    @endphp
                                    @foreach ($bag->shipment->groupBy('shipmentPackageId') as $key => $item)
                                        @foreach ($item as $package)
                                            @if ($loop->first)
                                                <tr>
                                                    <td>{{ $shipmentId++ }}.</td>
                                                    <td><a
                                                            href="{{ route('shipmentpackage.show', $package->shipmentPackage->id) }}">
                                                            {{ @$package->shipmentPackage->barcode }}
                                                        </a>
                                                    </td>
                                                    <td> {{ @$package->shipmentPackage->senderAttention }} </td>
                                                    <td> {{ @$package->shipmentPackage->receiverAttention }} </td>
                                                    <td>{{ @$package->shipmentPackage->totalPiece }}</td>
                                                    <td>{{ @$package->shipmentPackage->total_weight }}</td>
                                                </tr>

                                                <tr>
                                                    <th style="border-bottom:none;border-left:none;background:none;"></th>
                                                    <th>Total Piece</th>
                                                    <th>Dimensions</th>
                                                    <th>weight</th>
                                                </tr>
                                            @endif
                                            <tr class="pkg-table">
                                                <td
                                                    style="border-right:none;border-left:none;border-top:none;border-bottom:none;">
                                                </td>

                                                <td>{{ $package->piece_number }}</td>
                                                <td>{{ $package->length . '*' . $package->width . '*' . $package->height }}
                                                </td>
                                                <td>{{ $package->weight }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
