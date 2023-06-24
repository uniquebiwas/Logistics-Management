   <!-- About Section -->
   <section class="about-sec pt pb">
       <div class="container">
           <div class="main-title">
               <h2>{{ $sitesetting->front_counter_description }}</h2>
               {{-- <a href="{{ route('getPage', ['getPage' => 'contact']) }}" class="animate-charcter">
                   YOUR SHIPMENT OUR NETWORK YOUR DESTINATION SAFELY DELIVERED
               </a> --}}
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
                       <div class="abt-wrap {{ $key == 1 ? 'active' : '' }}" data-aos="zoom-in" data-aos-delay="200">
                           <div class="abt-icon">
                               {{-- <i class="flaticon-construction"></i> --}}

                               @if ($service->icon)
                                   <img src="{{ $service->feature_image }}" alt="">
                               @endif
                           </div>
                           <div class="abt-content">
                               <h3><a href="{{ route('serviceDetails', $service->slug) }}">{{ $service->title }}</a>
                               </h3>
                               <p>
                                   {{ str_limit(strip_tags($service->full_description), 140) }}
                               </p>
                               <a href="{{ route('serviceDetails', $service->slug) }}" class="abt-btn">Read More
                                   <i class="las la-arrow-circle-right"></i></a>
                           </div>
                       </div>
                   </div>
               @endforeach


           </div>
       </div>
   </section>
   <!-- About Section End -->
