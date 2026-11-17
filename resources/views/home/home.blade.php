@include("Header::header")
@php
$videoPath = $data['bannervideos']->video_path;
$image = $data['bannervideos']->image;
@endphp
    <section class="hero-banner position-relative d-md-block d-none" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $image) }}');">
      <!-- Desktop Video -->
      <video width="100%" height="100%" autoplay muted loop playsinline class=" video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
        <source src="{{url('/')}}/assets/upload/bannervideo/{{$videoPath}}" type="video/mp4">
        Your browser does not support the video tag.
      </video>

      <!-- Mobile Video -->
      <!-- <video width="100%" height="100%" autoplay muted loop playsinline
             class="d-md-none d-block video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
        <source src="{{url('/')}}/assets/homeVid.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video> -->
    </section>
    <style type="text/css">
      .video-placeholder {
          z-index: 2;
          object-fit: cover;
        }

        .video-element {
          z-index: 1;
          position: relative;
        }

    </style>

    <!-- Hero Section -->
    <section class="hero-section pt-15 pt-lg-0">
      <div class="container-fluid px-0 overflow-hidden">
        <div class="row align-items-center mx-0">
          <!-- Image Column -->
          <div class="col-lg-6 p-lg-0 px-0">
            <div class="swiper invest-slider">
              <div class="swiper-wrapper">
                 @foreach($data['section1slider'] as $section1)
                <div class="swiper-slide">
                  <div class="hero-image">
                    <img
                      src="{{url('/')}}/assets/upload/homeslider/{{ $section1->image }}"
                      alt="Chefs preparing food"
                      class="img-fluid"
                    />
                  </div>
                </div>
                
                  @endforeach
                
              </div>
              <div class="swiper-pagination"></div>
                <!-- Navigation buttons -->
                <!-- <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div> -->
            </div>
            
          </div>

          <!-- Content Column -->
          <div class="col-lg-6 ">
            <div class="hero-content p-lg-10 p-5">
              <h2 class="orange" data-aos="fade-up">{!!$data['slidercontent']->title!!}</h2>
              {!! $data['slidercontent']->content!!}
              <!-- <p class="pt-lg-8 py-4 pb-lg-4  desc-text" >
                At Academy of Pastry and Culinary Arts Malaysia (APCA), we
                blend innovation and creativity with modern hands-on
                approach to offer an unparalleled pastry and culinary
                education.
              </p>
              <p class="desc-text">
                Our award-winning instructors and diverse programs are
                designed to ignite your creativity and refine your skills. Join us
                to celebrates the art of pastry and culinary in every delightful
                creation. Let’s make something extraordinary together. You
                belong with the best.
              </p> -->
                <!-- <div class=" mt-10">
                    <a href="{{url('/')}}/about-us" class="btn btn-primary see-more-btn blue-btn">EXPLORE NOW</a>
                </div> -->

                <div class=" mt-10">
                    <a href="" class="btn btn-primary see-more-btn w-45 blue-btn">LEARN MORE</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- courses offered -->
    <!-- Courses Section -->
    @include("Home::program_home")
    <!-- <section class="hero-section courses-section d-lg-block d-none"> -->
    <section class="hero-section courses-section ">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-lg-6 p-lg-0  ">
            <div class="swiper invest-slider">
              <div class="swiper-wrapper">
                @foreach($data['section2slider'] as $section2)
                <div class="swiper-slide">
                  <div class="hero-image">
                    <img
                      src="{{url('/')}}/assets/upload/homeslider/{{ $section2->image }}"
                      alt="Chefs preparing food"
                      class="img-fluid"
                    />
                  </div>
                </div>
                @endforeach

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-6 ">
            <div class="hero-content p-5">
              <h2 class="blue" data-aos="fade-up">{{$data['slidercontent']->title2}}</h2>
                {!! $data['slidercontent']->content2!!}
              <!-- <p class="pt-lg-8 py-4 pb-lg-4  desc-text">
                Through our partnership with GEM and GeSS, APCA offers
                global paid internship (6-11 months) , providing real-life
                working experience in Michelin-starred restaurants,
                patisseries and hotels in France, Spain, Italy, Australia,
                Maldives and Mauritius. Many of our students have thrived
                in our global internship program, and you can too.
              </p>
              <ul class="banner-list">
                  <li><a href="{{url('/')}}/course/advanced-diploma-in-pastry-bakery-arts">Advanced Diploma in Pastry & Bakery Arts</a></li>
                  <li><a href="{{url('/')}}/course/advanced-diploma-in-culinary-arts">Advanced Diploma in Culinary Arts</a></li>
                  <li><a href="{{url('/')}}/course/advanced-diploma-dual-program">Advanced Diploma Dual Program</a></li>
              </ul> -->
                <div class=" mt-10">
                    <a href="{{url('/')}}/international-paid-internship" class="btn btn-primary see-more-btn w-45 blue-btn">GET STARTED</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- <section class="student-showcase d-lg-none d-block">
      <div class="banner-container">
        <h2 class="banner-title mobile-title blue-md ps-3">Complete the program <br> with a paid internship<br> in France</h2>
        <img src="{{url('/')}}/assets/images/home/ifilTower12.jpg" alt="Eiffel Tower in Paris" class="banner-image">
        
        <div class="banner-overlay">
            <div class="container">
                <div class="banner-content">
                    <h2 class="banner-title d-lg-block d-none">Complete the program with a paid internship in France</h2>
                    
                    <p class="banner-text">
                    Through our partnership with GEM and GeSS, APCA offers
                    global paid internship (6-11 months) , providing real-life
                    working experience in Michelin-starred restaurants,
                    patisseries and hotels in France, Spain, Italy, Australia,
                    Maldives and Mauritius. Many of our students have thrived
                    in our global internship program, and you can too.
                    </p>
                    <ul class="banner-list  px-6 px-lg-0">
                      <li><a href="{{url('/')}}/course/advanced-diploma-in-pastry-bakery-arts">Advanced Diploma in Pastry & Bakery Arts</a></li>
                      <li><a href="{{url('/')}}/course/advanced-diploma-in-culinary-arts">Advanced Diploma in Culinary Arts</a></li>
                      <li><a href="{{url('/')}}/course/advanced-diploma-dual-program">Advanced Diploma Dual Program</a></li>
                  </ul>
                    <div class=" mt-10  px-6 px-lg-0">
                        <a href="{{url('/')}}/about-us" class="btn btn-primary see-more-btn w-45 blue-btn">LEARN MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    @include('Home::testimonials_home')
    <div class="container my-15">
      <h2 class="section-title orange blue-md mb-5" data-aos="fade-up">Student Work</h2>
      <div class="students-studying">
        <img src="{{url('/')}}/assets/upload/studentsection/{{$data['student']->image}}" alt="Student Chef" class="img-fluid">
      </div>
    </div>

    @include('Home::partners')

    <section class="centres-section">
      <div class="container-fluid">
        <div class="row">
          <!-- Left Column - Accordion -->
          <div class="col-lg-6 ps-lg-15 py-10">
            <div class="row">
              <div class="col-md-7 offset-md-2">
              <h2 class="section-title mb-4 blue text-lg-start text-center" data-aos="fade-up">Worldwide Campuses</h2>
                <div class="accordion" id="accordionRight">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button
                        class="accordion-button text-uppercase collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo"
                        aria-expanded="true"
                        aria-controls="collapseTwo"
                      >
                        APCA India, Bangalore
                      </button>
                    </h2>
                    <div
                      id="collapseTwo"
                      class="accordion-collapse collapse show"
                      aria-labelledby="headingTwo"
                      data-bs-parent="#accordionRight"
                    >
                      <div class="accordion-body">No. 18/2A, Khata No 629/1, Ambalipura, Bellandur Gate, Sarjapur Main Road, Bengaluru East, Karnataka-560102</div>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button
                        class="accordion-button text-uppercase collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseOne"
                        aria-expanded="true"
                        aria-controls="collapseOne"
                      >
                        APCA India, Gurugram
                      </button>
                    </h2>
                    <div
                      id="collapseOne"
                      class="accordion-collapse collapse"
                      aria-labelledby="headingOne"
                      data-bs-parent="#accordionRight"
                    >
                      <div class="accordion-body">
                        <p class="address mb-3">
                          Plot No. 37-38, Udyog Vihar<br />Phase IV, Gurgaon,
                          Haryana
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button
                        class="accordion-button text-uppercase collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseThree"
                        aria-expanded="false"
                        aria-controls="collapseThree"
                      >
                        APCA India, Mumbai
                      </button>
                    </h2>
                    <div
                      id="collapseThree"
                      class="accordion-collapse collapse"
                      aria-labelledby="headingThree"
                      data-bs-parent="#accordionRight"
                    >
                      <div class="accordion-body">A Wing, Ground & First Floor, Litolier Chambers, Adjacent to Marol Metro Station, Andheri East, Mumbai</div>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                      <button
                        class="accordion-button text-uppercase "
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseFive"
                        aria-expanded="false"
                        aria-controls="collapseFive"
                      >
                        APCA Malaysia
                      </button>
                    </h2>
                    <div
                      id="collapseFive"
                      class="accordion-collapse collapse"
                      aria-labelledby="headingFive"
                      data-bs-parent="#accordionRight"
                    >
                      <div class="accordion-body">16, Jalan 51a/223, Seksyen 51a, 46100
                      Petaling Jaya, Selangor, Malaysia</div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                      <button
                        class="accordion-button text-uppercase collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseSeven"
                        aria-expanded="false"
                        aria-controls="collapseSeven"
                      >
                        APCA Indonesia
                      </button>
                    </h2>
                    <div
                      id="collapseSeven"
                      class="accordion-collapse collapse"
                      aria-labelledby="headingSeven"
                      data-bs-parent="#accordionRight"
                    >
                      <div class="accordion-body">The Flavor Bliss, Unit FB2 No. 19-20
                      Jl. Alam Sutera Boulevard, Pakulonan, Serpong Utara
                      Tangerang Selatan, Banten, 15325, Indonesia.  </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingphi">
                      <button
                        class="accordion-button text-uppercase collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsephi"
                        aria-expanded="false"
                        aria-controls="collapseSeven"
                      >
                        APCA Philippines
                      </button>
                    </h2>
                    <div
                      id="collapsephi"
                      class="accordion-collapse collapse"
                      aria-labelledby="headingphi"
                      data-bs-parent="#accordionRight"
                    >
                      <div class="accordion-body">Treston International College, University Parkway District, 32nd St. corner C-5 Road, Bonifacio Global City, Taguig, Philippines  </div>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                      <button
                        class="accordion-button text-uppercase collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseSix"
                        aria-expanded="false"
                        aria-controls="collapseSix"
                      >
                        APCA Singapore
                      </button>
                    </h2>
                    <div
                      id="collapseSix"
                      class="accordion-collapse collapse"
                      aria-labelledby="headingSix"
                      data-bs-parent="#accordionRight"
                    >
                      <div class="accordion-body">1 Expo Drive, #01-31 Singapore Expo, Singapore 486150</div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- Right Column - Map -->
          <div class="col-lg-6 p-0">
            <div class="map-container">
              <img
                src="{{url('/')}}/assets/images/home/12.png"
                alt="APCA Centres Map"
                class="img-fluid"
              />
            </div>
          </div>
        </div>
      </div>
    </section>

  

    

@include('Home::faqs_home')

@include('Footer::footer')