<div class="col-lg-4 col-md-12">
    <div class="details-sidebar">
        <div class="row">
            @if (isset($content_right_advertise) && !empty($content_right_advertise))
                @foreach ($content_right_advertise as $key => $advertise)
                    @include('layouts.advertise-section')
                @endforeach
            @endisset
        </div>
    </div>
    @if($is_news_loaded)
    <div class="trending-section">
        <h3>ताजा समाचार</h3>
        <ul>
            @if (isset($latest_news) && $latest_news->count())

                @foreach ($latest_news as $key => $latest_news_data)
                    <li>
                        <div class="trending-number">
                            <span>{{ $key + 1 }}.</span>
                        </div>
                        <div class="trending-title">
                            <a href="{{ route('newsDetail', $latest_news_data->slug) }}">
                                {{ @$latest_news_data->title['np'] }} </a>
                        </div>
                    </li>

                @endforeach
            @endif
        </ul>
    </div>
    @endif
</div>