<section class="testimonial-section py-10 pt-md-10 pt-0 course-testimonials bgContent" id="testimonials" >
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-12">
        <div class="program-testimonials">
        <h2 class="section-title ps-md-10">What students are saying</h2>
          <div class="swiper program-testimonials-slider">
            <div class="swiper-wrapper">
              @foreach($data['testimonial'] as $testimonial)
              <div class="swiper-slide">
                <div class="row">
                    <div class="col-lg-7 position-relative">
                      <!-- Testimonial Content -->
                      <div class="testimonial-content">
                        
                        <blockquote class="testimonial-quote ">
                  
                           {!! $testimonial->description !!}
                        </blockquote>
                        <h4 class="student-name text-uppercase orange">{{ $testimonial->name }}</h4>
                        <h5 class="orange">{{ $testimonial->program }}</h5>

                      </div>
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
            <!-- Navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>
      <!-- Content Column -->
      
    </div>
  </div>
</section>