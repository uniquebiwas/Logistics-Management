@extends('layouts.admin')
@section('title', 'Serviceable Coutnry')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Serviceable Country List</h3>
                    <div class="card-tools">
                        <a href="{{ route('serviceable-country.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="btn-group">
                        <a href="" class="btn btn-primary btn-flat btn-sm">
                            <i class="fas fa-sync-alt fa-sm"></i> Refresh
                        </a>
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('editCountries') }}" class="btn btn-success btn-sm btn-flat mr-2">
                            <i class="fa fa-plus"></i>Update Country List</a>
                    </div>
                </div>
                <div class="card-body card-format">
                    <table class="table table-striped table-hover"> {{-- table-bordered
                        --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($countries) && $countries->count())
                                @foreach($countries as $key => $country)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $country->name }}</td>

                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                  Showing <strong>{{ $countries->firstItem() }}</strong>  to <strong>{{ $countries->lastItem() }} </strong>  of <strong> {{$countries->total()}}</strong> entries
                                  <span> | Takes <b>{{ round((microtime(true) - LARAVEL_START),2) }}</b> seconds to render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{$countries->links()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
