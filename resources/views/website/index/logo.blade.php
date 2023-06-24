      <!-- Logo Partner -->
      <section class="logo-partner mt mb">
          <div class="container">
              <div class="main-title1">
                  <h2>Our Partners</h2>
              </div>
              <div class="owl-carousel owl-theme" id="partner">
                  @foreach ($partners as $key => $partner)
                      <div class="item" data-aos="flip-up" data-aos-delay="{{ $key + 200 }}">
                          <div class="partner-wrap">
                              <a href="javascript:void(0)"><img src="{{ $partner->image }}"
                                      alt="images" class="img-fluid"></a>
                          </div>
                      </div>
                  @endforeach

              </div>
          </div>
      </section>
      <!-- Logo Partner End -->
