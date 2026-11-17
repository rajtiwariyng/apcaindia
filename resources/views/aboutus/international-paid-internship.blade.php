@include("Header::header-fixed")
    <section class="explore-banner hero-banner" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $data['banner']->image) }}');">
        @if(!empty($data['banner']->video_path))
            <video width="100%" height="100%" autoplay muted loop playsinline class="video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
                <source src="{{ url('/assets/upload/bannervideo/' . $data['banner']->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
      <!-- <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>-->
      <div class="container position-relative">
          <div class="row min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title top-banner-title blue fs-2 fw-medium">International Paid Internship
                      Opportunities</h2>
                  </div>
              </div>
          </div>
      </div>
      <!-- <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>  -->
      @endif
    </section>

     <!-- Community/Alumni Section -->
     <section class="container mt-12">
          <div class="row">
              <div class="col-lg-6 text-center">
                  <!-- <h2 class="blue">APCA Malaysia</h2> -->
              </div>
              <div class="col-lg-6">
                {!!$data['intcontent']->content!!}
                  <!-- <p class="section-description">
                  Through our exclusive partnerships with GEM and
                    GeSS, APCA students gain access to paid
                    international internships lasting 6 to 11 months.
                    After completing the Advanced Diploma, eligible
                    graduates can train and earn in some of the world’s
                    top culinary destinations—including France, Spain,
                    Italy, Australia, the Maldives, and Mauritius.
                  </p>
                  <p>This is your opportunity to gain global experience,
                    build your network, and elevate your career on the
                    international stage.</p> -->
                  <!-- <button class="btn blue-btn">Brochure Download</button> -->
              </div>
          </div>
      </section>

    <!-- Courses Section -->
    <section class="courses-section py-lg-15 py-10 paidInterships" >
      <div class="container">
        <div class="">
          <!-- <h2 class=" title blue mb-5 fw-medium">Exciting global experience available after completion of the Advanced Diplomaprograms, and it is optional.</h2> -->
          <h2 class=" title blue mb-5 fw-medium">{!!$data['intcontent']->program_title!!}</h2>
          
        </div>

        <!-- Swiper -->
        <div class="courses-slider-wrapper  position-relative">
          <div class="mt-10">
            <div class="row ">
              @foreach ($data['intprograms'] as $program)
              @php
                // Detect position for mobile layout
                $isFirstTwo = $loop->index < 2;
              @endphp
              <div class="col-lg-3 col-md-4 {{ $isFirstTwo ? 'col-12' : 'col-6' }}">
                <a href="{{ empty($program->slug) || $program->slug == '#' ? '#' : url('/international-paid-internship/' . $program->slug) }}">
                  <div class="course-card">
                    <div class="course-image">
                      <img
                        src="{{ url('/assets/upload/intprogram/' . $program->image) }}"
                        alt="Pastry & Culinary Arts"
                      />
                    </div>
                    <div class="course-content">
                      <h3 class="course-category orange text-uppercase">
                       {{ $program->name }}
                      </h3>
                      <h4 class="course-title fs-5 fw-normal black">{{ $program->duration }}</h4>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
              <!-- <div class="col-lg-3 col-md-4">
                <a href="{{url('/')}}/course/advanced-diploma-in-pastry-bakery-arts">
                  <div class="course-card">
                    <div class="course-image">
                      <img
                        src="{{url('/')}}/assets/images/interships/InternationInternship_France.jpg"
                        alt="Pastry & Culinary Arts"
                      />
                    </div>
                    <div class="course-content">
                      <h3 class="course-category orange text-uppercase">
                       France
                      </h3>
                      <h4 class="course-title fs-5 fw-normal black">6 months paid internship</h4>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-4">
                <a href="{{url('/')}}/course/advanced-diploma-in-culinary-arts">
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/images/interships/InternationInternship_Spain.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                  <div class="course-content">
                    <h3 class="course-category orange text-uppercase">
                      spain
                    </h3>
                    <h4 class="course-title fs-5 fw-normal black">6–9 months paid
                    Internship</h4>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-4 col-6">
                <a href="{{url('/')}}/course/days-24-intensive-pastry-program">
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/images/interships/InternationInternship_Italy.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                  <div class="course-content">
                    <h3 class="course-category orange text-uppercase">
                    ITALY
                    </h3>
                    <h4 class="course-title fs-5 fw-normal black">8–11 months paid
                    internship</h4>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-4 col-6">
                <a href="{{url('/')}}/course/days-24-intensive-pastry-program">
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/images/interships/InternationInternship_Maldives.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                  <div class="course-content">
                    <h3 class="course-category orange text-uppercase">
                    MALDIVES & MAURITIUS
                    </h3>
                    <h4 class="course-title fs-5 fw-normal black">6 months paid internship</h4>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-4 col-6">
                <a href="{{url('/')}}/course/weeks2-intensive-chocolate-program">
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/images/interships/InternationInternship_Australia.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                  <div class="course-content">
                    <h3 class="course-category orange text-uppercase">
                    AUSTRALIA
                    </h3>
                    <h4 class="course-title fs-5 fw-normal black">1 year internship and job
                        placement (*Minimum of 1
                        Year Working Experience)</h4>
                  </div>
                </div>
                </a>
              </div> -->
         
            </div>
          </div>
        </div>
        <hr>
      </div>
    </section>
      <!-- Accommodation Section -->
    <section class="container pb-15" id="accommodation">
        <div class="row">
            <div class="col-lg-6 ps-md-10 pt-5 pt-md-0">
                <h2 class="section-title mb-10 fw-medium position-relative">{!!$data['intcontent']->students_title!!}</h2>
                {!!$data['intcontent']->description!!}
            </div>
            <div class="col-lg-6 p-0">
                <div>
                <iframe width="100%" height="600" src="https://www.youtube.com/embed/{{$data['intcontent']->url}}?si=3XQS-am1sbz8twq-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
            
        </div>
    </section>

@include('Footer::footer')