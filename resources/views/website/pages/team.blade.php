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
<!-- Team Page Us -->
<section class="team mt mb">
    <div class="container">
        <div class="row">
            @foreach ($teams as $item)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="team-wrap">
                    <div class="team-img">
                        <img src="{{@$item->image}}" alt="images">
                    </div>
                    <div class="team-content">
                        <h3>{{($item->full_name['en']) ? $item->full_name['en'] : $item->full_name['np'] }}</h3>
                        <span>{{@$item->designation->title['en'] ?? @$item->designation->title['np']}}</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Team Page End -->
@endsection
