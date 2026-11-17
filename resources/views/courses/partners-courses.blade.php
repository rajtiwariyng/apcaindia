<section class="partners-section">
                <div class="container">
                  <h2 class="section-title">Placement Partners</h2>
                  <!-- <p class="section-description mb-5">
                    Lorem ipsum dolor sit amet, consectetuer<br />adipiscing elit, sed
                    diam nonummy nibh euismod.
                  </p> -->

                  <div class="position-relative partner-slider pt-10">
                    <div class="swiper partnersSwiper">
                      <div class="swiper-wrapper">
                        @foreach($data['placementpartners'] as $partners)
                          <div class="swiper-slide">
                            <div class="partner-logo">
                              <img
                                src="{{url('/')}}/assets/upload/placementpartners/{{ $partners->image }}"
                                alt="{{ $partners->name }}"
                                class="img-fluid"
                              />
                            </div>
                          </div>
                           @endforeach

                        
                      </div>
                    </div>
                    <!-- Navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  </div>

                  <div class="text-center mt-10">
                    <button class="btn btn-primary blue-btn">SEE MORE</button>
                  </div>
                </div>
              </section>