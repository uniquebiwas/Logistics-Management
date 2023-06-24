@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <h2 class="text-center display-4">Track Shipment

        </h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('shipmentpackage.trackfedex') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="search" class="form-control form-control-lg"
                            placeholder="Type your tracking code here">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
