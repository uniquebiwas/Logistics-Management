@extends('layouts.admin')
@section('title', 'Credit To agent')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#agents').select2();
        });
    </script>
@endpush
@section('content')
    @include('admin.section.ckeditor')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ ucwords($type) }} Form</h3>
                    <div class="card-tools">
                        <a href="{{ route('agents.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="card-body">
                        @if ($credit->id)
                            {!! Form::open(['url' => route('agent-credit.update', $credit->id)]) !!}
                            @method('patch')
                        @else
                            {!! Form::open(['url' => route('agent-credit.store')]) !!}
                        @endif
                        @csrf
                        <input type="hidden" value="{{ @$type }}" name="type" />
                        <div class="form-group">
                            <label for="agentId">Agent Name</label>
                            {!! Form::select('agentId', $agent, [request()->userId, $credit->agentId], ['class' => 'form-control form-control-sm select2', 'id' => 'agents', 'disabled' => $credit->agentId ? true : false]) !!}
                            @error('agentId')
                                <small id="helpId" class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Remarks</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Remarks"
                                aria-describedby="helpId" value="{{ old('title', $credit->title) }}" >
                            @error('title')
                                <small id="helpId" class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control ckeditor" name="description" id="description"
                                rows="3">{!! old('description', $credit->description) !!}</textarea>

                            @error('description')
                                <small id="helpId" class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div> --}}



                        <div class="form-group">
                            <label for="credit Amount">{{ucwords($type)}} Amount</label>
                            <input type="number" name="creditAmount" id="creditAmount" class="form-control"
                                placeholder="credit Amount" aria-describedby="helpId"
                                value="{{ old('creditAmount', $credit->creditAmount) }}">
                            @error('creditAmount')
                                <small id="helpId" class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        @if ($type == 'credit')
                            <div class="form-group">
                                <label for="dueDate">Due Date</label>
                                <input type="date" name="dueDate" id="dueDate" class="form-control" placeholder="dueDate"
                                    aria-describedby="helpId" required value="{{ old('dueDate',optional($credit->dueDate)->toDateString()) }}">
                                @error('dueDate')
                                    <small id="helpId" class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        @endif




                        <div class="form-group">
                            <button type="submit" class="global-btn">Submit</button>
                            <button type="reset" class="global-btn">Reset</button>

                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
