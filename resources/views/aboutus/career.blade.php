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
                        <h1 class="faculty-title">Career</h1>
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

     <!-- INTERNSHIP -->
     <section>
      <div class="container">
       
          <div class="pt-md-10">
            <div class="highlight-card">
              <h2 class="title orange fw-medium">Internship</h2>

              <div class="">
                      <p>
                      Internships in the best culinary schools in India play a crucial role in shaping a chef's career, allowing them to learn and grow professionally. While the academy provides a controlled environment with access to the best culinary arts courses in India, the reality of working in hotels and restaurants is different, with added pressures of volume, cost, and performance. It is highly recommended at least 3 months of internship with leading restaurants, bakeries, and 5-star hotels prepare students for this chef courses in India. These internships are unpaid but provide valuable experience.
                      </p>
                      <p>

                      </p>
                      </div>
                            
            </div>
          </div>
       
      </div>
    </section>

    <!-- JOB OPPORTUNITIES -->
     <section>
      <div class="container">
       
          <div class="">
            <div class="highlight-card">
              <h2 class="title orange fw-medium">Job Opportunities</h2>

              <div class="">
                      <p>
                      Chefs of 5 Star Hotels and leading restaurants/bakeries come to us for training. They appreciate our standards and are keen to hire our students in their properties. You would find most of our alumni working in leading hotels in major cities in the country and international locations.
                    </p>
                    <p>
                    In the last leg, we conduct training on how to open own bakery/restaurant, how to arrive at the costing, etc. This is very helpful to students who want to open their own venture after completing the course.
                    </p>
                    <p>

                        We send the resume of students who complete the advance diploma with us six weeks before their course gets over. They are then called for interview/skill test. Since our students gets trained hands on, they have no problem in clearing the interview.
                    </p>
                      </div>
                            
            </div>
          </div>
       
      </div>
    </section>

  <!-- Locations -->
  <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 py-lg-15 py-10">

              <p class="title orange fw-bold">Gurgaon Center</p>
          <div class="">
             <p>
             Plot No. 37-38, Udyog Vihar Phase IV, Gurgaon, Haryana
             </p>
             <p>
             +91-844 844 9002
             </p>
             <p>
             info@apcaindia.com
             </p>
          </div>
            
          </div>
          <div class="col-md-4 py-lg-15 py-10">
          <p class="title orange fw-bold">Bangalore Center</p>
          <div class="">
             <p>
             No. 18/2A, Khata No 629/1, Ambalipura, Bellandur Gate, Sarjapur Main Road, Bengaluru East, Karnataka-560102
             </p>
             <p>
             +91-844 844 9002
             </p>
             <p>
             info@apcaindia.com
             </p>
          </div>
          </div>
          <div class="col-md-4 py-lg-15 py-10">
          <p class="title orange fw-bold">Mumbai Center</p>
          <div class="">
             <p>
             A Wing, Ground & First Floor, Litolier Chambers, Adjacent to Marol Metro Station, Andheri East, Mumbai
             </p>
             <p>
             +91-844 844 9002
             </p>
             <p>
             info@apcaindia.com
             </p>
          </div>
          </div>
        </div>
      </div>
    </section>
<!-- <iframe class="mt-10" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.4022103751827!2d77.0438532!3d28.5877083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1b4755c6dc73%3A0x1be775dc2d702eb9!2sAPCA%20-%20Academy%20of%20Pastry%20%26%20Culinary%20Arts%20%2C%20Delhi%20-%20School%20For%20Baking%20%26%20Culinary%20Arts!5e0!3m2!1sen!2sin!4v1776162433794!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
@include('Footer::footer')