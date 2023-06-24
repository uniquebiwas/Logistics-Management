@extends('layouts.front')
@section('page_title', @$gallery->title)
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')

 <!-- Banner -->
        <section class="banner pt pb" style="background-image: url({{ asset('front/img/banner.jpg')}};background-size:cover;">
            <div class="container">
                <h1>{{@$gallery->title}}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{@$gallery->title}}</li>
                    </ol>
                </nav>
            </div>
        </section>
        <!-- Banner End -->

        <!-- Gallery Details -->
        <section class="gallery-details mt mb">
            <div class="container">
                <div class="row">
                    <div class="gallery-details-wrap">
                        <ul id="lightgallery" class="row">
                        @isset($gallery->galleryImage)
                        @foreach ($gallery->galleryImage as $item)
                             <li class="col-lg-3 col-md-4 col-sm-6" data-src="{{ @$item->image}}">
                                <a href="">
                                    <img src="{{ @$item->image}}" alt="images">
                                    {{-- <span>Office Meeting 2021</span> --}}
                                </a>
                            </li>
                        @endforeach
                        @endisset

                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Gallery Details Page End -->

@endsection
