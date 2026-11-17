@include("Header::header")
<?php $segment = Request::segment(1); ?>
<section class="achievment-banner hero-banner" style="background-image: url('./assets/images/achivements/rectangle_1.png')">
      <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative">
          <div class="row align-items-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title">THE HERITAGE OF BAKING.. REVERED BY US</h2>
                      <p class="faculty-subtitle">Learn from a highly experienced culinary team, in state-of-the-art facilities at India, Malaysia,</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
    </section>
    <section>
      <div class="container-fluid py-15">
        <div class="row g-4 pb-10">
          <div class="col-md-6 ps-md-15 pe-10">
            <div class="highlight-card">
              <span class="tag">Sep 2023</span>
              <h2 class="orange faqUnderline">India Pastry Cup 2023: A Journey Through Culinary Artistry and Innovation in the World of Pastry</h2>
              <p>Celebrating Excellence in Culinary Arts: Chef Sehaj and Chef Pratyay Achieve a Remarkable Milestone... Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus eaque eum ut cum cumque, obcaecati quia consectetur, consequuntur maiores fugiat iste expedita beatae exercitationem. Facilis impedit tempore tempora. Alias, illo.</p>
              <a href="achivements-gallery.html" class="btn blue-btn">VIEW HIGHLIGHTS</a>
            </div>
          </div>
          <div class="col-md-6 p-0">
            <img src="{{url('/')}}/assets/images/achivements/rectangle_2_2.png" alt="Placeholder Image" class="img-fluid image-fullwidth">
          </div>
        </div>
        <div class="row pb-10">
          <div class="col-md-6 p-0">
            <img src="{{url('/')}}/assets/images/achivements/rectangle_2_2.png" alt="Placeholder Image" class="img-fluid image-fullwidth">
          </div>
          <div class="col-md-6 ps-md-15 pe-10">
            <div class="highlight-card">
              <span class="tag">Oct 2022</span>
              <h2 class="orange faqUnderline">Mondial de Art Sucre 2022: A Global Showcase of Sugar Artistry and Culinary Talent</h2>
              <p>India made waves by winning the esteemed Prix de l'Originalité. Our talented team showcased exceptional skill.. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione magnam qui asperiores tempora placeat facilis, libero deleniti cum ab rerum blanditiis maxime veniam exercitationem molestias sequi, iure temporibus recusandae illo?</p>
              <a href="achivements-gallery.html" class="btn blue-btn">VIEW HIGHLIGHTS</a>
            </div>
          </div>
        </div>
        <div class="row g-4 pb-10">
          <div class="col-md-6 ps-md-15 pe-10">
            <div class="highlight-card">
              <span class="tag">Sep 2023</span>
              <h2 class="orange faqUnderline">India Pastry Cup 2023: A Journey Through Culinary Artistry and Innovation in the World of Pastry</h2>
              <p>Celebrating Excellence in Culinary Arts: Chef Sehaj and Chef Pratyay Achieve a Remarkable Milestone... Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio dolores amet officia nulla tempore et maxime, numquam excepturi recusandae vero labore rerum modi blanditiis laboriosam reiciendis temporibus animi? Incidunt, velit!</p>
              <a href="achivements-gallery.html" class="btn blue-btn">VIEW HIGHLIGHTS</a>
            </div>
          </div>
          <div class="col-md-6 p-0">
            <img src="{{url('/')}}/assets/images/achivements/rectangle_2_2.png" alt="Placeholder Image" class="img-fluid image-fullwidth">
          </div>
        </div>
      </div>
    </section>
    
    

    <section class="partners-section">
      <div class="container pb-15">
        <h2 class="section-title">Placement Partners</h2>
        <p class="section-description mb-5">
          Lorem ipsum dolor sit amet, consectetuer<br />adipiscing elit, sed
          diam nonummy nibh euismod.
        </p>

        <div class="position-relative partner-slider pt-10">
          <div class="swiper partnersSwiper">
            <div class="swiper-wrapper">
              <!-- Partner 1 -->
              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/17.png"
                    alt="Taj Hotels"
                    class="img-fluid"
                  />
                </div>
              </div>

              <!-- Partner 2 -->
              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/18.png"
                    alt="JW Marriott"
                    class="img-fluid"
                  />
                </div>
              </div>

              <!-- Partner 3 -->
              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/19.png"
                    alt="The Leela"
                    class="img-fluid"
                  />
                </div>
              </div>

              <!-- Additional partners for continuous loop -->
              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/17.png"
                    alt="The Oberoi"
                    class="img-fluid"
                  />
                </div>
              </div>

              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/18.png"
                    alt="ITC Hotels"
                    class="img-fluid"
                  />
                </div>
              </div>
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
@include('Footer::footer')