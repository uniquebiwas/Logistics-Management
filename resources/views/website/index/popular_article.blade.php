    <!-- Blog -->
    <section class="blog pt pb">
        <div class="container">
            <div class="main-title1">
                <h2>Popular Articles</h2>
                <p>Follow Us For More News</p>
            </div>
            <div class="row">
            @php $delay = 300; @endphp

            @forelse ($articles as $item)
                 <div class="col-lg-4 col-md-6">
                    <div class="blog-wrap" data-aos="flip-left" data-aos-delay={{@$delay}}>
                        <div class="blog-img">
                            <a href="{{ route('blogDetails', $item->slug) }}"><img src="{{ @$item->featured_img }}" alt="images"></a>
                            <div class="date"><b>{{readableDate(@$item->created_at,'d')}}</b> {{readableDate(@$item->created_at,'M')}}</div>
                        </div>
                        <div class="blog-content">
                            <h3><a href="{{ route('blogDetails', $item->slug) }}">{{@$item->title['en'] ?? @$item->title['np']}}</a></h3>
                            <p>
                               {{-- {!! str_limit(strip_tags(@$item->description['en'] ?? @$item->description['np']),135) !!} --}}
                               {!! html_entity_decode(@$item->summary['en'] ?? @$item->summary['np']) !!}
                            </p>
                        </div>
                    </div>
                </div>
            @php $delay = $delay + 300; @endphp

            @empty
                
            @endforelse
                
            </div>
        </div>
    </section>
    <!-- Blog End -->
