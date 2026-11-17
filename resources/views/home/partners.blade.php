<section class="partners-section pb-15">
      <div class="container">
        <div class="text-lg-start text-center">
          <h2 class="section-title blue" data-aos="fade-up">Placement Partners</h2>

        </div>
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
            <div class="swiper-pagination"></div>
          </div>
          <!-- Navigation buttons -->
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
    </section>