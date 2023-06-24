@extends('layouts.front')
@section('page_title', @$blog->title['en'] ?? @$blog->title['np'])
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')

    <!-- Banner -->
    <section class="banner pt pb" style="background-image: url({{ @$blog->parallex_img }})">
        <div class="container">
            <h1>{{ @$blog->title['en'] ?? @$blog->title['np'] }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ @$blog->title['en'] ?? @$blog->title['np'] }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Details -->
    <section class="details-page mt mb">
        <div class="container">
            <div class="details-wrap">
                <div class="details-left">
                    <div class="date">
                        <b>{{ $blog->created_at->format('d') }}</b>{{ $blog->created_at->format('M') }}
                    </div>
                </div>
                <div class="details-right">
                    <h2> {{ @$blog->title['en'] }}</h2>
                    <img src="{{ $blog->featured_img }}" alt="images">

                    {!! html_entity_decode($blog->description['en']) !!}
                </div>
            </div>
        </div>
    </section>
    <!-- Details End -->
@endsection
