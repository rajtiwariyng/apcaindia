@include("Header::header-fixed")
<?php $segment = Request::segment(1); ?>
@php
    $image = $data['banner']->image ?? '6914296410430_Screenshot 2025-11-12 115933.png';
@endphp

<style>
.course-image {
  position: relative;
  overflow: hidden;
}

.course-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: 0.3s ease;
}

/* Hover ONLY on image */
.course-image:hover .course-overlay {
  opacity: 1;
}

.course-extra-content {
  display: none;
}

.course-extra-content.show {
  display: block;
}
</style>


<section class="course-banner hero-banner" style="background-image: url('/assets/images/courses/advanceddiploma-in-culinary/advanceddiploma-in-culinary.jpg');">
      <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative banner-content">
          <div class="row align-items-center min-vh-75">
              <div class="col-lg-9">
                  <div class="content-wrapper" data-aos="fade-right">
                      <div class="banner-title-container">
                        <h1 class="faculty-title">Recipes and Inspiration</h1>
                      </div>
                      <div class="text-white">
                        <p>

                          Connect with APCA Chef to explore world-class culinary training, expert mentorship, and opportunities that shape your future in the global kitchen.
                        </p>
                        <p class="d-none d-md-block">
                          Share your details and let APCA Chef guide you toward a successful career in culinary arts with internationally recognized programs.
                        </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
</section>

    <!-- Recipe and Inspiration -->
    <section>
      <div class="container">
        <div class="row">

        <div class="col-md-6 h-100 py-lg-15 py-10">
            <img src="{{url('/')}}/assets/images/home/07.png" alt="foundermsg" class="img-fluid image-fullwidth h-100">
          </div>

          <div class="col-md-6 py-lg-15 pt-10">
            <div class="highlight-card">
              <h2 class="title orange fw-medium">Feel Good Pastry</h2>

              <div class="fs-6">

                      <!-- Visible Initially -->
                      <p class="fs-4">
                      Doing things right always taste better
                      </p>

                      <p>
                        By enrolling in the APCA culinary or pastry full-time programs in Delhi, aspiring chefs and pastry chefs have the opportunity to receive top-notch education, gain practical experience, and enhance their career prospects in the culinary world.
                      </p>
                      <p>
                          The APCA Culinary & Pastry course provides comprehensive training in all aspects of culinary arts. Students gain hands-on experience in various culinary techniques, menu planning, food preparation, and kitchen management. The program is designed to equip students with the skills and knowledge needed to excel in the culinary industry.
                        </p>

                        <p>
                        With an area of 20,000 sq. ft. the APCA Delhi facility has 9 kitchens along with a student lounge, cafeteria, store and an oven room. Individual attention and learning from fundamentals set the Academy part in the current competitive landscape.
                        </p>

                        
                      <!-- Read More Hyperlink -->

                      <!-- Hidden Content -->
                      <div id="delhiCourseMoreContent" class="course-extra-content mt-3">

                      <p>
                        The seasoned team from the Delhi branch encompasses industry experts and illustrious winners of India Pastry Championship for 2015 & 2017, with an overall 3rd position in Asia ranking. These honors are a testament to the high-quality training provided by APCA and the success of its graduates in the culinary industry.
                        </p>


                        <p>
                          Enroll now to pursue your passion and contribute to the vibrant world of culinary arts.
                        </p>

                      </div>

                      <span
                        id="toggleDelhiContent"
                        class="btn btn-primary see-more-btn w-45 blue-btn mt-5"
                      >
                        Download Now
                      </span>

                      <!-- Existing Button Kept Intact -->
                      <!-- <div class=" mt-10">
                          <a href="" class="btn btn-primary see-more-btn w-45 blue-btn">LEARN MORE</a>
                      </div> -->

                      </div>
                            
            </div>
          </div>
         
        </div>
      </div>
    </section>

<!-- <iframe class="mt-10" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.4022103751827!2d77.0438532!3d28.5877083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1b4755c6dc73%3A0x1be775dc2d702eb9!2sAPCA%20-%20Academy%20of%20Pastry%20%26%20Culinary%20Arts%20%2C%20Delhi%20-%20School%20For%20Baking%20%26%20Culinary%20Arts!5e0!3m2!1sen!2sin!4v1776162433794!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
@include('Footer::footer')