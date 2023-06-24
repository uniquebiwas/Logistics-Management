@extends('layouts.front')
@section('page_title', @$blog->title)
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')

    <!-- Banner -->
    <section class="banner pt pb" style="background-image: url({{ @$blog->icon }});">
        <div class="container">
            <h1>{{ @$blog->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ @$blog->title }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Details -->
    <section class="details-page mt mb">
        <div class="container">
            <div class="details-wrap">
                {{-- <div class="details-left">
                    <div class="date">
                        <b>{{ $blog->created_at->format('d') }}</b>{{ $blog->created_at->format('M') }}
                    </div>
                </div> --}}
                <div class="details-right">
                    <div class="row">
                        <div class="col-lg-5 col-md-12">
                            <img src="{{ $blog->feature_image }}" alt="images">
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <h2> {{ @$blog->title }}</h2>
                            {!! html_entity_decode($blog->full_description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Details End -->
@endsection
