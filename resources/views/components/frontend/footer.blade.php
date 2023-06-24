  <!-- Footer -->
  <footer class="footer">
      <div class="cloud cloud1">
          <div class="light"></div>
          <img src="{{ asset('front/img/plane3.png') }}" alt="images">
      </div>
      <div class="shape1"></div>
      <div class="shape2"></div>
      <div class="shape3"></div>
      <div class="container">
          <div class="row">
              <div class="col-lg-3">
                  <div class="footer-contact">
                      <a href="{{ route('index') }}"><img src="{{ $appSetting->logo }}" alt="images"></a>
                      <p>
                        {{$appSetting->footer_description}}
                      </p>
                      <ul>
                        @if ($appSetting->facebook)
                        <li class="facebook"><a href="{{ $appSetting->facebook }}"><i
                                    class="lab la-facebook-f"></i></a></li>
                    @endif
                    @if ($appSetting->youtube)
                        <li class="youtube"><a href="{{ $appSetting->youtube }}"><i
                                    class="lab la-youtube"></i></a></li>
                    @endif
                    @if ($appSetting->twitter)
                        <li class="skype"><a href="{{ $appSetting->twitter }}"><i
                                    class="lab la-twitter"></i></a></li>
                    @endif
                    @if ($appSetting->skype)
                        <li class="skype"><a href="{{ $appSetting->skype }}"><i
                                    class="lab la-skype"></i></a></li>
                    @endif

                      </ul>
                  </div>
              </div>

              <div class="col-lg-3 col-md-4">
                  <div class="footer-links links-only">
                      <h3>Our Services</h3>
                      {{-- <ul>
                          @foreach ($usefulLinks as $item)
                              <li><a
                                      href="{{ $item->external_url ?? route('getPage', $item->slug) }}">{{ $item->title['en'] ?? $item->title['np'] }}</a>
                              </li>
                          @endforeach

                      </ul> --}}
                      {{-- <ul>
                                  <li><a href="#">GSA / CSA & Brand Representation</a></li>
                                  <li><a href="#">One-Stop Logistic Solution</a></li>
                                  <li><a href="#">Project Cargo Handling</a></li>
                                  <li><a href="#">Perishable Cargo Management</a></li>
                                  <li><a href="#">Legal Counseling & Documentation</a></li>
                              </ul> --}}

                    <ul>
                        @foreach ($services as $service)
                            <li><a href="{{route('serviceDetails', $service->slug)}}">{{$service->title}}</a></li>
                        @endforeach
                    </ul>

                  </div>
              </div>
              <div class="col-lg-3 col-md-4">
                  <div class="footer-info">
                      <h3>Contact Us</h3>
                      <ul>
                        <li>
                            <i class="flaticon-home"></i>
                            <span>{{ @$appSetting->name }}</span>
                        </li>
                        <li>
                            <i class="flaticon-smartphone"></i>
                            <span>G.P.O. Box : 24884</span>
                        </li>
                          <li>
                              <i class="flaticon-signs"></i>
                              <span>{{ @$appSetting->address }}</span>
                          </li>
                          <li>
                              <i class="flaticon-phone-call"></i>
                              <span>{{ @$appSetting->phone[0]['phone_number'] }}</span>
                          </li>
                          <li>
                              <i class="flaticon-message"></i>
                              <span>{{ @$appSetting->email }}</span>
                          </li>
                      </ul>
                      {{-- <ul>
                                  <li>Air Logistic Group</li>
                                  <li>G.P.O. Box : 24884</li>
                                  <li>Gairidhara,Kathmandu Nepal</li>
                                  <li>(+977)-01-4004795/96</li>
                                  <li>office@airlogisticsgroup.asia</li>
                              </ul> --}}
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="footer-cta">
                <h3>Find Us Here</h3>
                  <div class="footer-map">
                      <iframe
                          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3531.9982362846463!2d85.32277111458335!3d27.71734073166052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19c7d02e5427%3A0x6f2c9b7b7da70c15!2sAtlas%20Aviation%20Holding!5e0!3m2!1sen!2snp!4v1631273111526!5m2!1sen!2snp"
                          width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                  </div>
              </div>
            </div>
          </div>
      </div>
      </div>
  </footer>
  <!-- Footer End -->

  <!-- Footer Bottom -->
  <div class="
                              footer-bottom">
      <div class="container">
          <ul>
              <li>© 2021 Air Logistics Group. All Rights Reserved.</li>
              <li>Developed By: <a href="https://www.nectardigit.com/" target="_blank">Nectar
                      Digit</a></li>
          </ul>
      </div>
  </div>
  <!-- Footer Bottom End -->

  <!-- Scroll Top -->
  <div class="go-top">
      <div class="pulse">
          <i class="las la-angle-up"></i>
      </div>
  </div>
  <!-- Scroll Top End -->
