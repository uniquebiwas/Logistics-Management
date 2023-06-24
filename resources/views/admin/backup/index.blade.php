@extends('layouts.admin')
@section('title', 'Database Backup')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="offset-4 col-md-5">
                    {!! Form::open(['url' => route('database.backup')]) !!}
                    @csrf
                    <div class="info-box mb-3">
                        <span class="info-box-icon view-btn elevation-1">
                            <button type="submit" class="view-btn">
                                <i class="fas fa-download"></i>
                            </button>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Backup</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
