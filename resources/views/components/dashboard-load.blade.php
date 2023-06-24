<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">{{ $reportingDate }} Load Details</h3>
        <div class="card-tools">

            {!! Form::open(['method' => 'GET']) !!}
            <div class="row">
                {!! Form::date('requiredDate', request('requiredDate'), ['class' => 'form-control form-control-sm col-10', 'placeholder' => 'Load Date']) !!}
                {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'btn btn-tool col', 'type' => 'submit', 'title' => 'Search ']) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon">
                                <i class="fas fa-plane    "></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Awb</span>
                                <span class="info-box-number">{{ $todayData->total_awb }}</span>


                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon">
                                <i class="fas fa-balance-scale"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Weight</span>
                                <span class="info-box-number">{{ $todayData->weight ?? 0 }}</span>


                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fas fa-chart-pie"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Pieces</span>
                                <span class="info-box-number">{{ $todayData->totalPiece ?? 0 }}</span>


                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            </div>

            <div class="col-8">
                <table class="table table-striped table-valign-middle table-sm">
                    <thead>
                        <tr>
                            <th>AWB</th>
                            <th>Date</th>
                            <th>Destination</th>
                            <th>Shipper / Consignee</th>
                            <th>Restore Shipment Load</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipments as $shipment)
                            <tr>
                                <td> <a href="{{ route('shipmentpackage.generate.awb', $shipment->id) }}"
                                        target="_blank">
                                        {{ $shipment->awb_number }}</a></td>
                                <td>{{ $shipment->shipment_date->format('y-M-d') }}</td>
                                <td>

                                    {{ $shipment->receiverCountry }}
                                </td>
                                <td>
                                    {{ $shipment->senderName . ' / ' . $shipment->receiverCompany }}
                                </td>

                                <td>
                                    {!! Form::open(['url' => route('load.destroy', $shipment->id), 'class' => 'deleteLoadForm', 'data-awb' => $shipment->awb_number]) !!}
                                    @method('DELETE')
                                    {!! Form::button('<i class="fas fa-recycle"></i>', ['class' => 'view-btn', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    No Load Planning for {{ $reportingDate }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="text-right mt-2">
                        <tr>
                            <td colspan="9">{{ $shipments->links() }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $('.deleteLoadForm').on('submit', (e) => {
            awb = e.target.getAttribute("data-awb");
            return confirm(`Do you want to  delete ${awb}  Awb?`)
        })
    </script>
@endpush
