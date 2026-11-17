@include("Header::header")
<section class="faq-banner hero-banner" style="background-image: url('./assets/images/FAQs/layer_3.jpg')">
      <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative">
          <div class="row align-items-md-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title top-banner-title">Visit The Academy</h2>
                      <p class="faculty-subtitle top-banner-subtitle">Book a campus tour</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
    </section>
      <!-- Community/Alumni Section -->
      
      <section class="container-fluid my-5">
          <div class="row align-items-center">
              <div class="col-lg-6 p-5">
                  <video width="100%" height="100%" autoplay muted loop class="d-md-block d-none">
                    <source src="{{url('/')}}/assets/school-tour-by-chef-Niklesh.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>
              </div>
              <div class="col-lg-6 ps-md-16 pe-md-10 pt-5 pt-md-0">
                  <h2 class="section-title faqUnderline mb-10 position-relative orange">Book a campus tour</h2>
                  <p class="top-banner-subtitle" style="color: #111f90;">Duration: Approximately 30 min</p>
                  <p class="section-description">
                      We encourage you to schedule a tour of the school so that you can experience the Academy of Pastry Arts at its full glory! Upon your arrival here, we will bring you to visit the school facilities so you can discover our state-of-the-art teaching facilities as well as observing how the classes are carried out. <br> 

                      Career Guidance Day is a 2-day FREE program which allows you to engage in both Culinary and Pastry hands-on skill where you'll get to learn up to 6 recipes. This would assist you better to make the right choice in your career path by giving you insights on how to be a chef. This is a best platform for school leavers to get advice about your study options, meet with our Award Winning Chefs and discover what it would be like to study in our Academy. If you are interested to attend, kindly reserve your seat below
                  </p>
              </div>
          </div>
      </section>

      <section class="contact-us py-lg-15 py-10">
      <div class="container">
        <!-- Header -->
        <h2 class="appointment-title mb-8">Book a campus tour</h2>
        
        <!-- Description -->
        <p class="description-text mb-5"></p>

        @include("Footer::bookcampustourform")
    
      </div>
    </section>



@include('Footer::footer')