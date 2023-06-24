@extends('layouts.admin')
@section('title', 'National Manifest')
@push('scripts')

@endpush

@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">National Manifest List</h3>
                    <div class="card-tools">
                        <a href="{{ route('national-manifest.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                        <a href="{{ route('national-manifest.edit', $nationalManifest->id) }}" type="button"
                            class="btn btn-tool bg-dark">
                            Add Bag</a>
                    </div>
                </div>

                <div class="card-body">
                    @foreach ($bag as $items)
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title text-capitalize">{{ $items->name }}</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>ShipmentCode</th>
                                                <th>Sender</th>
                                                <th>Receiver</th>
                                                <th>Pcs</th>
                                                <th>weight</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($items->getAllShipmentAttribute($items->shipmentIds) as $key => $package)
                                                <tr>
                                                    <td>{{ $package->barcode }}
                                                    </td>
                                                    <td>{{ $package->senderAttention }}</td>
                                                    <td>{{ $package->receiverAttention }}
                                                    </td>
                                                    <td>
                                                        {{ $package->totalPiece }}
                                                    </td>
                                                    <td>{{ $package->total_chargeable_weight }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {!! Form::open(['url' => route('nationalmanifestBagDelete', $nationalManifest->id)]) !!}
                                @csrf
                                <input type="hidden" name="name" value="{{ $items->name }}">
                                <button type="submit" class="btn btn-sm btn-info float-left">delete</button>
                                {!! Form::close() !!}

                            </div>
                            <!-- /.card-footer -->
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
