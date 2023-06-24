@extends('layouts.front')
@section('page_title', @$pagedata->title['en'] ?? @$pagedata->title['np'])
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')


    <!-- Banner -->
    <section class="banner pt pb" style="background-image: url({{@$pagedata->parallex_img_url}});background-size:cover;">
        <div class="container">
            <h1>{{@$pagedata->title['en'] ?? @$pagedata->title['np']}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{@$pagedata->title['en'] ?? @$pagedata->title['np']}}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End -->
    <!-- About Us Page -->
    <section class="about-page mt mb">
        <div class="container">
            <h2 class="page-title">{{@$pagedata->title['en'] ?? @$pagedata->title['np']}}</h2>
            <div class="page-content">
                {!! @$pagedata->description['en'] ?? @$pagedata->description['np'] !!}
            </div>
        </div>
    </section>
    <!-- About Us Page End -->

@endsection
