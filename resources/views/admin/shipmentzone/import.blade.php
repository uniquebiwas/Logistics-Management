@extends('layouts.admin')
@section('title', 'Zone')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">

        <div class="container-fluid">
            <div class="card">
                <div class="card-header" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        Zone Data Excel
                    </h3>
                    <div class="card-tools">
                        <a name="Download CSV" id="" class="btn btn-warning" href="{{ route('import-shipment-zone-download') }}" role="button">Download Example CSV</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('import-shipment-zone-store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="callout callout-warning">
                            <div class="form-group">
                                <label for="excelFile">ExcelFile</label>
                                <input type="file" class="form-control-file" name="excelFile" id="" placeholder="ExcelFile"
                                    aria-describedby="fileHelpId">
                                @error('excelFile')
                                    <small id="fileHelpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>


            </div>

        </div>

    </section>

@endsection
