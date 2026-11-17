<section class="testimonial-section">
      <div class="container bg-blue pt-10 mt-15">
        <div class="row align-items-center">
          <!-- Content Column -->
          <div class="col-lg-12 position-relative">
            <!-- Testimonial Content -->
            <div class="testimonial-content">
              <h2 class="section-title orange">What students are saying</h2>
              <div class="testimonial-wrapper position-relative">
                <div class="swiper testmonial-slider">
                  <div class="swiper-wrapper">
                    @foreach($data['testimonial'] as $testimonial)
                      <div class="swiper-slide">
                          <div class="row">
                            <div class="col-lg-8 pe-md-10">
                                <blockquote class="testimonial-quote orange">
                                    {!! $testimonial->description !!}
                                </blockquote>
                                <h5 class="orange pt-8">{{ $testimonial->name }}, {{ $testimonial->program }}</h5>
       
                            </div>
                            <div class="col-lg-4">
                              <div class="testimonial-image">
                                <img
                                  src="{{url('/')}}/assets/upload/testimonial/{{ $testimonial->image }}"
                                  alt="Student Chef"
                                  class="img-fluid"
                                />
                              </div>
                            </div>
                          </div>
                          
                      </div>
                      @endforeach

                  </div>
                  <div class="swiper-pagination"></div>
                </div>
               
              </div>
             
              
            </div>
          </div>
          
        </div>
      </div>
    </section>