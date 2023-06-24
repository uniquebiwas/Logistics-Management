@extends('layouts.admin')
@section('title', $title)
@section('content')
    <section class="content-header mt-0 pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Documents List</h3>

                            <div class="card-tools">

                                <a href="{{ route('sendDocuments') }}" class="btn btn-success btn-sm btn-flat mr-2">

                                    <i class="fa fa-plus"></i> Submit Document
                                </a>

                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body card-format">
                                <div class="row">
                                    @if (isset($documents) && $documents->count())
                                        @foreach ($documents as $key => $document)

                                            <div class="col-lg-4">
                                                <h4 class="text-info ">
                                                    {{ ucFirst(str_replace('_', ' ', @$document->documentType)) }}</h4>
                                                <a href="{{ $document->file_path }}">
                                                    {!! getEventProgramFileThumb($document->file_path) !!}
                                                </a>
                                                <hr>
                                                <ul style="list-style: none">
                                                    <li>Status : <strong>{{ $document->status }}</strong></li>
                                                    <li>Submitted At :
                                                        <strong>{{ ReadableDate($document->created_at, 'all') }}</strong>
                                                    </li>
                                                    @if ($document->status == 'verified')
                                                        <li>Verified At :
                                                            <strong>{{ ReadableDate($document->verifiedAt, 'all') }}</strong>
                                                        </li>
                                                        <li>Verified By:
                                                            <strong>{{ $document->verifier->name['en'] }}</strong>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-lg-12">
                                            You do not have submitted documents yet.
                                        </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
