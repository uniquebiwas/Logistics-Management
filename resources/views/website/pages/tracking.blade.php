@extends('layouts.front')
@section('page_title', @$pagedata->title['en'] ?? @$pagedata->title['np'])
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')
    <!-- Banner -->
    <section class="banner pt pb"
        style="background-image: url({{ @$pagedata->parallex_img_url }});background-size:cover;">
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
    <!-- Newsletter -->
    <section class="tracking-page mt mb">
        <div class="container">
            <div class="row">
                <div class="shipment-wrapper" data-aos="fade-down-right" data-aos-delay="300">
                    <div class="container">

                        <div class="shipment-search">
                            <h2>Track your shipment</h2>
                            <form action="{{ route('clientPackageSearch') }}" method="GET" target="_blank">
                                {{-- @csrf --}}
                                <div class="form-wrap">
                                    {!! Form::text('tracking_id', @request()->barcode, ['class' => 'form-control mb-2', 'placeholder' => 'Type your barcode Number here', 'required' => true]) !!}

                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                            @error('tracking_id')
                                <p class="form-text text-danger">
                                    *{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter End -->
    <section class="tracking-page mb">
        {{-- @isset($package)
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">{{ $package->senderAddress }}</a>
                @foreach ($package->shipmentLocation as $item)
                    <a href="#" class="list-group-item list-group-item-action">{{ $item->location }}</a>
                @endforeach
            </div>
        @endisset --}}
        <div class="container">
            <div class="tracking-wrap">
                @isset($shipmentLocation)

                    @foreach ($shipmentLocation as $item)
                        <div class="timeline">
                            <span>{{ @$item[0]->date->format('d M Y') }}</span>
                            <ul>
                                <li>
                                    <i class="fas fa-plane-departure"></i>
                                    <div class="timeline-items">

                                        @foreach ($item as $location)
                                            @php
                                                switch ($location->package_status) {
                                                    case 'PENDING':
                                                        $status = 'AWB GENERATED ( Shipment information received)';
                                                        break;
                                                    case 'DISPATCHED':
                                                        $status = 'SHIPMENT IN TRANSIT';
                                                        break;

                                                    default:
                                                        $status = $location->package_status;
                                                        break;
                                                }

                                            @endphp
                                            <div class="timeline-repeat">
                                                <b>{{ readableDate($location->date, 'time') }} |
                                                   {{ ucwords(strtolower($location->extra_status ?? $status)) }}</b>
                                                <p><i
                                                        class="fas fa-map-marker-alt"></i>{{ucwords(strtolower(@$location->location .', '. @$location->country->name))}}
                                                </p>
                                                <p>{{ @$package->getItems->count() }} piece</p>
                                            </div>
                                        @endforeach


                                    </div>
                                </li>

                            </ul>
                        </div>
                    @endforeach
                    {{-- <div class="timeline">
                    <span>{{@$package->date->format('d M Y')}}</span>
                    <ul>

                        <li>
                            <i class="fas fa-plane-departure"></i>
                            <div class="timeline-items">
                                <div class="timeline-repeat">
                                    <b>{{readableDate($package->date,'time')}} | AWB Generated</b>
                                    <p><i class="fas fa-map-marker-alt"></i> {{ @$package->senderCity }} , {{ @$package->senderCountry }}</p>
                                    <p>{{@$package->getItems->count()}} piece</p>
                                </div>

                            </div>
                        </li>
                    </ul>
                </div> --}}
                @endisset
                {{-- <div class="timeline">
                    <span>16 Sep 2021</span>
                    <ul>
                        <li>
                            <i class="fas fa-plane-departure"></i>
                            <div class="timeline-items">
                                <p><i class="fas fa-map-marker-alt"></i> <b>Address:</b> Kathmandu</p>
                                <p><i class="fas fa-check-circle"></i> <b>Status:</b> Collected</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="timeline">
                    <span>17 Sep 2021</span>
                    <ul>
                        <li>
                            <i class="fas fa-plane-departure"></i>
                            <div class="timeline-items">
                                <p><i class="fas fa-map-marker-alt"></i> <b>Address:</b> Kathmandu</p>
                                <p><i class="fas fa-check-circle"></i> <b>Status:</b> Collected</p>
                            </div>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </section>



@endsection
