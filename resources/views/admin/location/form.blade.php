@extends('layouts.admin')
@section('title', 'Location')
@push('scripts')
    <script>

    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $location->type ?? 'Location' }} FORM</h3>
                    <div class="card-tools">
                        <a href="{{ route('location.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="card-body">
                        @if ($location->id)
                            {!! Form::open(['url' => route('location.update', ['location' => $location->id, 'type' => request()->type])]) !!}
                            @method('PATCH')
                        @else
                            {!! Form::open(['url' => route('location.store', ['type' => request()->type])]) !!}
                        @endif
                        @csrf
                        <div class="form-group offset-md-3 col-md-6">
                            {!! Form::label('title', $location->type . ' NAME') !!}
                            {!! Form::text('title', $location->title, ['class' => 'form-control', 'placeholder' => '', 'id' => 'title']) !!}
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {!! Form::hidden('type', $location->type ?? request()->type) !!}

                        <div class="form-group offset-3 ">
                            {!! Form::submit('submit', ['class' => 'global-btn']) !!}
                            <button class='global-btn' type="reset">Reset</button>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
