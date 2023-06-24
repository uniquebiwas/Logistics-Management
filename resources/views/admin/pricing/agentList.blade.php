@extends('layouts.admin')
@section('title', @$title)
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.pricing.agent') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                        @can('pricing-create')
                            @if (request()->is('nd-admin/agent-pricing'))
                                <a href="{{ route('admin.pricing.agent.create') }}" class="global-btn mr-1">
                                    <i class="fa fa-plus"></i> New Agent Pricing</a>
                                <a href="{{ route('import-shipment-zone') }}" class="global-btn mr-1">
                                    <i class="fas fa-file-import"></i> Import Excel</a>
                            @else
                                <a href="{{ route('pricing.create') }}" class="global-btn mr-1">
                                    <i class="fa fa-plus"></i> New Pricing</a>
                            @endif
                            <a name="Download CSV" id="" class="global-btn"
                                href="{{ route('import-shipment-zone-download') }}" role="button">CSV format</a>

                        @endcan
                    </div>
                </div>
                <div class="card-body search-body">
                    <form action="" class="row">
                        @isset($agentList)
                            <div class="col-lg-5 col-md-4">
                                {!! Form::select('agentId', $agentList, request()->agentId, ['class' => 'form-control form-control-sm select2', 'placeholder' => 'Select Agent']) !!}
                            </div>
                        @endisset

                        <div class="col-lg-2 col-md-2 col-sm-2">
                            {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn','type' => 'submit','title' => 'Search ']) }}
                        </div>
                    </form>

                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">S.n</th>
                                @if (request()->is('nd-admin/agent-pricing'))
                                    {{-- <th>Agent Code</th> --}}
                                    <th>Company</th>
                                    <th>Upload Date</th>
                                    <th>Telephone</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                @endif
                                <th>Service Agent</th>

                                {{-- <th>Status</th> --}}
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                {{-- {{ dd(@$value->getWeightPrice) }} --}}
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    @if (request()->is('nd-admin/agent-pricing'))
                                        {{-- <th>{{ @$value->getLocalAgent->accountNumber }}</th> --}}
                                        <td>{{ @$value->getLocalAgent->agent_profile->company_name }}</td>
                                        <td>{{ $value->effectiveDate->format('d, F  Y') }}</td>

                                        <td>{{ @$value->getLocalAgent->agent_profile->phone }}</td>
                                        <td>{{ @$value->getLocalAgent->mobile }}</td>
                                        <td>{{ @$value->getLocalAgent->email }}</td>
                                    @endif
                                    <td>{{ @$value->getAgent->title }}</td>


                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('pricing.show', $value->id) }}" title="show pricing"
                                                class="view-btn mr-1">
                                                <i class="fas fa-eye"></i></a>
                                            @can('pricing-delete')
                                                {{ Form::open(['method' => 'DELETE','route' => ['pricing.destroy', $value->id],'style' => 'display:inline','onsubmit' => 'return confirm("Are you sure you want to delete this pricing?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn','type' => 'submit','title' => 'Delete pricing ']) }}
                                                {{ Form::close() }}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                    Showing <strong>{{ $data->firstItem() }}</strong> to
                                    <strong>{{ $data->lastItem() }} </strong> of <strong>
                                        {{ $data->total() }}</strong>
                                    entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $data->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
