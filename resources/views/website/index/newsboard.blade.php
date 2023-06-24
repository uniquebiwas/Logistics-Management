<!-- News -->
<section class="news pt pb">
    <div class="container">
        <div class="main-title1">
            <h2>Recent Updates</h2>
            {{-- <p>Follow Us For More News</p> --}}
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <div class="news" data-aos="fade-right" data-aos-delay="300">
                    <ul>
                        @forelse ($news as $item)
                            <li class="news-list">
                                <div class="news-left">
                                    <div class="news-img">
                                        <a href="#">
                                            <img src="{{ $item->featured_img }}" alt="images">
                                        </a>
                                    </div>
                                </div>
                                <div class="news-right">
                                    <h3><a
                                            href="{{ route('blogDetails', $item->slug) }}">{{ @$item->title['en'] ?? @$item->title['np'] }}</a>
                                    </h3>
                                    <div class="dates">
                                        <b>{{ date('d M, Y', strtotime(@$item->created_at)) }}</b>
                                    </div>
                                </div>
                            </li>
                        @empty

                        @endforelse

                    </ul>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="information" data-aos="fade-left" data-aos-delay="600">
                    <ul>

                        @foreach ($information as $key => $item)
                            <li>
                                <div class="inform-icon">
                                   <img src="{{$item->image}}" alt="">
                                </div>
                                <div class="inform-content">
                                    <span>{{ $item->title }}</span>
                                    <p>
                                        {{ $item->description }}
                                    </p>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News End -->
