   <!-- Home Gallery -->
   <section class="h-gallery pt">
       <div class="container">
           <div class="main-title1">
               <h2>Our Galleries</h2>
               <p>See Our Photo</p>
           </div>

           <div class="owl-carousel owl-theme" id="h-gallery">
               @isset($galleries)
                   @foreach ($galleries as $item)
                       <div class="item" data-aos="zoom-in" data-aos-delay="200">
                           <div class="album-wrap">
                               <a title="" href="{{ route('galleryPage', $item->slug) }}">
                                   <div class="g-img">
                                       <img src="{{ @$item->featured_img }}" alt="images">
                                   </div>
                                   <span>{{ @$item->title }}</span>
                                   <p>{{ $item->galleryImage->count() . 'Photos' }}</p>
                               </a>
                           </div>
                       </div>
                   @endforeach

               @endisset

           </div>
       </div>
   </section>
   <!-- Home Gallery End -->
