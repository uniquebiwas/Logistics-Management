@extends('layouts.admin')
@section('title', 'shipmentZone')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Location & Service Agent</h3>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="p-1 col-lg-6">
                            <form action="" class="">
                                <div class=" row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::select('agentService', $serviceAgent, request()->agentService, ['class' => 'form-control form-control-sm', 'placeholder' => 'Integrator']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-6">
                            <div class="card-tools float-right d-flex text-sm">
                                @can('zonal-create')
                                    <a href="{{ route('zonal.create') }}" class="global-btn mr-2">
                                        <i class="fa fa-plus"></i> Add New Shipment Zones</a>
                                @endcan
                                @can('zonal-import')
                                    <a href="{{ route('zonal-import') }}" class="global-btn mr-2">
                                        <i class="fas fa-upload    "></i> Import Zone</a>
                                @endcan
                                <a name="Download CSV" id="" class="global-btn"
                                    href="{{ route('zonal-import-export') }}" role="button">CSV example</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">

                    @foreach ($serviceAgents as $key => $item)
                        <div class="row">
                            @if (count($item))
                                @php
                                    $count = ceil(count($item) / 3);
                                @endphp
                                @foreach ($item->chunk($count) as $item)
                                    <div class="col-4">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="50%">Countries</th>
                                                    <th width="50%">Zone</th>
                                                    <th width="50%">Integrator</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($item as $itemKey => $itemDetails)
                                                    @if ($itemKey % 2 == 0)
                                                        <tr>
                                                            <td>{{ $itemDetails->name }}</td>
                                                            <td>{{ $itemDetails->title }}</td>
                                                            <td>{{ $itemDetails->servicetitle }}</td>

                                                        </tr>

                                                    @else
                                                        <tr>
                                                            <td>{{ $itemDetails->name }}</td>
                                                            <td>{{ $itemDetails->title }}</td>
                                                            <td>{{ $itemDetails->servicetitle }}</td>
                                                        </tr>
                                                    @endif

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach

                            @endif
                        </div>

                    @endforeach
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection
