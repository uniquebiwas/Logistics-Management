@extends('layouts.front')
@section('page_title', @$pagedata->title['en'] ?? @$pagedata->title['np'])
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')
    <section class="banner pt pb" style="background-image: url({{ @$pagedata->parallex_img_url }});background-size:cover;">
        <div class="container">
            <h1>{{ @$pagedata->title['en'] ?? @$pagedata->title['np'] }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ @$pagedata->title['en'] ?? @$pagedata->title['np'] }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Services Page -->
    <section class="about-sec service-page pt pb">
        <div class="container">
            <div class="main-title">
                {{-- <h2 class="animate-charcter">Your Shipment our Network Your Destination Safely Delivered</h2> --}}
                <ul>
                    <li><a href="javascript:void(0);">Your Shipment</a></li>
                    <li><a href="javascript:void(0);">Our Network</a></li>
                    <li><a href="javascript:void(0);">Your Destination</a></li>
                    <li><a href="javascript:void(0);">Safely Delivered</a></li>
                </ul>
                <a href="{{ route('getPage', ['getPage' => 'contact']) }}">Feel free to contact us</a>
            </div>
            <div class="row">
                @foreach ($services as $key => $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="abt-wrap" data-aos="zoom-in" data-aos-delay="200">
                            <div class="abt-icon">
                                @if ($service->feature_image)
                                    <img src="{{ $service->feature_image }}" alt="">
                                @endif
                            </div>
                            <div class="abt-content">
                                <h3><a href="{{ route('serviceDetails', $service->slug) }}">{{ $service->title }}</a>
                                </h3>
                                <p>
                                    {{ str_limit(strip_tags($service->full_description),140) }}
                                </p>
                                <a href="{{ route('serviceDetails', $service->slug) }}" class="abt-btn">Read More <i
                                        class="las la-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <nav aria-label="Page navigation example">
                {{ $services->links() }}
                {{-- <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true"><i class="las la-angle-double-left"></i></span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true"><i class="las la-angle-double-right"></i></span>
                        </a>
                    </li>
                </ul> --}}
            </nav>
        </div>
    </section>
    <!-- Services Page End -->
@endsection
