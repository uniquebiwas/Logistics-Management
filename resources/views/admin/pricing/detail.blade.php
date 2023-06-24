@extends('layouts.admin')
@section('title', 'Pricing Details')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <h3 style="margin-bottom: 10px; font-size:20px;">Pricing Table for {{ @$pricing_info->getLocalAgent->agent_profile->company_name}} ({{ $serviceAgents->title }})</h3>

            @foreach ($tables as $i => $items)

            <div class="card">
                <div class="card-header">
                    <span>{{$dates[$i]}}</span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0 " style="display: flex">
                    @foreach ($items as $key => $table)
                        @if ($loop->first)
                            <table class="table table-bordered mb-2" style="flex:1">
                                <thead>
                                    <tr>
                                        <th>
                                            weight
                                        </th>
                                        <th>{{ $key }}</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($table as $item)
                                        <tr>
                                            <td>
                                                {{ $item->weight }}
                                            </td>
                                            <td>
                                                {{ $item->price }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @continue
                        @endif
                        <table class="table table-bordered mb-2" style="flex:1">
                            <thead>
                                <tr>
                                    <th colspan="2">{{ $key }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table as $item)
                                    <tr>
                                        <td>
                                            {{ $item->price }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

    </section>

@endsection
