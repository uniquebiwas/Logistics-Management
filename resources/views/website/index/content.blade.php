 <!-- Content Section -->
 <section class="content-sec mt mb">
     <div class="container">
         <div class="row">
             <div class="col-lg-6 col-md-12">
                 <div class="content-sec-left" data-aos="fade-right" data-aos-delay="300">
                     <img src="{{ asset('front/img/slider4.jpg') }}" alt="images">
                 </div>
             </div>
             <div class="col-lg-6 col-md-12">
                 <div class="content-list" data-aos="fade-left" data-aos-delay="600">
                     <h3>Working with Air Logistic Group</h3>
                     <span>{{ @$benefit->title }}</span>

                     <p>{!! @$benefit->description !!}</p>
                     <div class="explore-wrap">
                         <div class="counter">
                             <div class="row">
                                 <div class="col-md-4 col-sm-4 col-xs-12">
                                    <a href="{{ url('service') }}" class="cnt-btn">Explore More</a>
                                 </div>
                                 <div class="col-md-4 col-sm-4 col-xs-12">
                                     <div class="counter-wrap">
                                         <div class="counter-icon">
                                             <i class="flaticon-book"></i>
                                         </div>
                                         <div class="counter-content">
                                             <span>25000+</span>
                                             <p>Package Delivered</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-4 col-sm-4 col-xs-12">
                                     <div class="counter-wrap">
                                         <div class="counter-icon">
                                             <i class="flaticon-people-1"></i>
                                         </div>
                                         <div class="counter-content">
                                             <span>2700+</span>
                                             <p>Satisfied Clients</p>
                                         </div>
                                     </div>
                                 </div>
                                 {{-- <div class="col-md-4 col-sm-4 col-xs-12">
                                     <div class="counter-wrap">
                                         <div class="counter-icon">
                                             <i class="flaticon-avatar"></i>
                                         </div>
                                         <div class="counter-content">
                                             <span>25+</span>
                                             <p>Award Winner</p>
                                         </div>
                                     </div>
                                 </div> --}}
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Content Section End -->
