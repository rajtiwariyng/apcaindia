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
                        <h1 class="faculty-title">Elevate Your Culinary Journey</h1>
                      </div>
                      <div class="text-white">
                        <p>

                          Connect with APCA Chef to explore world-class culinary training, expert mentorship, and opportunities that shape your future in the global kitchen.
                        </p>
                        <p class="d-none d-md-block">
                          Share your details and let APCA Chef guide you toward a successful career in culinary arts with internationally recognized programs.
                        </p>

                        <div class="mt-10">
                    <a href="" class="btn hero-orange-btn" 
                    style="background-color: var(--primary-orange);
                            color: white;
                            padding: 0.8rem 2rem;
                            border: none;
                            font-weight: 500;
                            text-transform: uppercase;
                            letter-spacing: 1px;
                            transition: all 0.3s ease;">ENQUIRE NOW</a>
                </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
</section>

     <!-- Baking & Pastry Courses Section -->
     <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6 py-lg-15 pt-10">
            <div class="highlight-card">
              <h2 class="title orange fw-medium">Baking & Pastry Courses in Delhi</h2>

              <div class="fs-6">

                      <!-- Visible Initially -->
                      <p>
                        Realise your culinary dreams with APCA Delhi.
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
                        Read More
                      </span>

                      <!-- Existing Button Kept Intact -->
                      <!-- <div class=" mt-10">
                          <a href="" class="btn btn-primary see-more-btn w-45 blue-btn">LEARN MORE</a>
                      </div> -->

                      </div>
                            
            </div>
          </div>
          <div class="col-md-6 h-100 py-lg-15 py-10">
            <img src="{{url('/')}}/assets/upload/homeslider/6979ee2bd1e43_031A0527%20(1).jpg" alt="foundermsg" class="img-fluid image-fullwidth h-100">
          </div>
        </div>
      </div>
    </section>

    <!-- Courses Section -->
    <section class="courses-section py-lg-15 pt-10 apca-programs" >
      <div class="container">
        <div class="">
          <!-- <h2 class=" title blue mb-5 fw-medium">Exciting global experience available after completion of the Advanced Diplomaprograms, and it is optional.</h2> -->
          <h2 class="title orange mb-5 fw-medium">Available Courses At Academy</h2>
          
        </div>

        <!-- Course Section Grid -->
        <div class="courses-section">
          <div class="mt-10">
            <div class="row ">
              
              <div class="col-lg-3 col-md-4 col-6">
                
                  <div class="course-card">
                    <div class="course-image">
                      <img
                        src="{{url('/')}}/assets/upload/homeprogram/6933e4ac8b1d7_5.jpg"
                        alt="Pastry & Culinary Arts"
                      />
                      <div class="course-overlay">
                        <button style="background:#ff7a00; color:#fff; border:none; padding:10px 20px; border-radius:4px; font-weight:600;">
                          Apply Now
                        </button>
                      </div>
                    </div>

                    <div class="course-content">
                  <h3 class="course-category orange text-uppercase">
                      9 MONTHS PROGRAM (FULL TIME)
                      </h3>
                      <h4 class="course-title fs-5-font blue">Pastry Advanced Diploma Program</h4>
                  </div>
                  </div>
            
              </div>
              <div class="col-lg-3 col-md-4 col-6">
                
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/upload/homeprogram/6933e4ac8b1d7_5.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                    <div class="course-overlay">
                        <button style="background:#ff7a00; color:#fff; border:none; padding:10px 20px; border-radius:4px; font-weight:600;">
                          Apply Now
                        </button>
                      </div>
                  </div>

                  <div class="course-content">
                  <h3 class="course-category orange text-uppercase">
                      9 MONTHS PROGRAM (FULL TIME)
                      </h3>
                      <h4 class="course-title fs-5-font blue">Pastry Advanced Diploma Program</h4>
                  </div>
                </div>
               
              </div>

              <div class="col-lg-3 col-md-4 col-6">
               
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/upload/homeprogram/6933e4ac8b1d7_5.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                    <div class="course-overlay">
                        <button style="background:#ff7a00; color:#fff; border:none; padding:10px 20px; border-radius:4px; font-weight:600;">
                          Apply Now
                        </button>
                      </div>
                  </div>

                  <div class="course-content">
                  <h3 class="course-category orange text-uppercase">
                      9 MONTHS PROGRAM (FULL TIME)
                      </h3>
                      <h4 class="course-title fs-5-font blue">Pastry Advanced Diploma Program</h4>
                  </div>
                </div>
             
              </div>

              <div class="col-lg-3 col-md-4 col-6">
               
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/upload/homeprogram/6933e4ac8b1d7_5.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                    <div class="course-overlay">
                        <button style="background:#ff7a00; color:#fff; border:none; padding:10px 20px; border-radius:4px; font-weight:600;">
                          Apply Now
                        </button>
                      </div>
                  </div>

                  <div class="course-content">
                  <h3 class="course-category orange text-uppercase">
                      9 MONTHS PROGRAM (FULL TIME)
                      </h3>
                      <h4 class="course-title fs-5-font blue">Pastry Advanced Diploma Program</h4>
                  </div>
                </div>
               
              </div>


              <div class="col-lg-3 col-md-4 col-6">
                
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/upload/homeprogram/6933e4ac8b1d7_5.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                    <div class="course-overlay">
                        <button style="background:#ff7a00; color:#fff; border:none; padding:10px 20px; border-radius:4px; font-weight:600;">
                          Apply Now
                        </button>
                      </div>
                  </div>

                  <div class="course-content">
                  <h3 class="course-category orange text-uppercase">
                      9 MONTHS PROGRAM (FULL TIME)
                      </h3>
                      <h4 class="course-title fs-5-font blue">Pastry Advanced Diploma Program</h4>
                  </div>
                </div>
               
              </div>

              <div class="col-lg-3 col-md-4 col-6">
                
                  <div class="course-card">
                  <div class="course-image">
                    <img
                      src="{{url('/')}}/assets/upload/homeprogram/6933e4ac8b1d7_5.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                    <div class="course-overlay">
                        <button style="background:#ff7a00; color:#fff; border:none; padding:10px 20px; border-radius:4px; font-weight:600;">
                          Apply Now
                        </button>
                      </div>
                  </div>

                  <div class="course-content">
                  <h3 class="course-category orange text-uppercase">
                      9 MONTHS PROGRAM (FULL TIME)
                      </h3>
                      <h4 class="course-title fs-5-font blue">Pastry Advanced Diploma Program</h4>
                  </div>
                </div>
                
              </div>
         
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Upcoming Intakes -->
    <section class="container">
      <div class="py-lg-15 pt-10">
        <div class="row g-4 justify-content-center align-items-center">
        <div class="col-md-6 h-100">
            <img src="{{url('/')}}/assets/upload/homeslider/6933e6486fa4a_2.jpg" alt="foundermsg" class="img-fluid image-fullwidth h-100">
          </div>
          <div class="col-md-6 ps-lg-10">
            <div class="highlight-card">
              <h2 class="title blue fw-medium">Upcoming Intakes</h2>

              <div class="row justify-content-center align-items-center gap-5">
                <!-- Intake - 1 -->
                  <div class="row p-0 col-12">

                    <div class="col-12 orange fs-4" style="font-weight: 600;">
                      Full Time Pastry & Bakery
      
                    </div>

                    <div class="fs-4">
                      17th August 2026
                    </div>
                  </div>
                <!-- Intake - 2 -->
                  <div class="row p-0 col-12">

                    <div class="col-12 orange fs-4" style="font-weight: 600;">
                      Full Time Culinary
                    </div>

                    <div class="fs-4">
                      18th May 2026
                    </div>
                  </div>
                <!-- Intake - 3 -->
                  <div class="row p-0 col-12">

                    <div class="col-12 orange fs-4" style="font-weight: 600;">
                      12 Week Intensive Course
                    </div>

                    <div class="fs-4">
                      25 May 2026
                    </div>
                  </div>
              </div>

              <div class=" mt-10">
                    <a href="" class="btn btn-primary see-more-btn w-45 blue-btn">APPLY NOW</a>
                </div>
  
        
            </div>
          </div>
      
        </div>
      </div>
    </section>

    <!-- Explore Our Centre -->
    <section class="courses-section py-10" >
      <div class="container">
        <div class="">
          <!-- <h2 class=" title blue mb-5 fw-medium">Exciting global experience available after completion of the Advanced Diplomaprograms, and it is optional.</h2> -->
          <h2 class="title orange mb-5 fw-medium">Explore Our Delhi Centre</h2>
          
        </div>

        <!-- Grid -->
        <div class="courses-section">
          <div class="mt-10">
            <div class="row g-4">
              
              <div class="col-md-4 col-6">
                <a href="{{url('/')}}/course/advanced-diploma-in-pastry-bakery-arts">
                  <div class="course-card">
                    <div class="instructor-image-container">
                      <img
                      class="instructor-image default-image"
                        src="{{url('/')}}/assets/upload/homeslider/6933e6486fa4a_2.jpg"
                        alt="Pastry & Culinary Arts"
                      />
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-md-4 col-6">
                <a href="{{url('/')}}/course/advanced-diploma-in-culinary-arts">
                  <div class="course-card">
                  <div class="instructor-image-container">
                    <img
                    class="instructor-image default-image"
                      src="{{url('/')}}/assets/upload/homeslider/6990408ba8a5d_83b590c3-3b49-49af-b09b-d0c07afcbeb1%20(1).png"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-4 col-6">
                <a href="{{url('/')}}/course/days-24-intensive-pastry-program">
                  <div class="course-card">
                  <div class="instructor-image-container">
                    <img
                    class="instructor-image default-image"
                      src="{{url('/')}}/assets/upload/homeslider/6979ee2bd1e43_031A0527%20(1).jpg"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-4 col-6">
                <a href="{{url('/')}}/course/days-24-intensive-pastry-program">
                  <div class="course-card">
                  <div class="instructor-image-container">
                    <img
                    class="instructor-image default-image"
                      src="{{url('/')}}/assets/upload/homeslider/6979e8b907f12__DSC6831%20(1).jpg"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-4 col-6">
                <a href="{{url('/')}}/course/weeks2-intensive-chocolate-program">
                  <div class="course-card">
                  <div class="instructor-image-container">
                    <img
                    class="instructor-image default-image"
                      src="{{url('/')}}/assets/upload/homeslider/697b1590c4017_DSC04508%20(1)%20(1).jpg"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-4 col-6">
                <a href="{{url('/')}}/course/weeks2-intensive-chocolate-program">
                  <div class="course-card">
                  <div class="instructor-image-container">
                    <img
                    class="instructor-image default-image"
                      src="{{url('/')}}/assets/upload/homeslider/6933e60231eef_4.jpg"
                      alt="Pastry & Culinary Arts"
                    />
                  </div>
                </div>
                </a>
              </div>
         
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Request A Call Back Form -->
     <!-- <section class="container">

        <div class="d-flex flex-column py-lg-15 py-10">

            <h2 class="title blue fw-medium mb-0">
            Request A Call Back
            </h2>

            <div class="flex flex-col w-100 align-items-center justify-content-center">

            <form class="row g-5 m-0 w-100">
                  <div class="col-12 col-md-6 sm:p-0 md:ps-0">
                    <input class="shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" type="text" placeholder="Name" name="form-name" id="f-name"/>
                  </div>

                  <div class="col-12 col-md-6 sm:p-0 md:pe-0">
                    <input class="shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" type="tel" placeholder="Phone" name="form-phone" id="f-phone"/>
                  </div>

                  <div class="col-12 col-md-6 sm:p-0 md:ps-0">
                    <input class="shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" type="email" placeholder="Email Id" name="form-email" id="f-email"/>
                  </div>

                  <div class="col-12 col-md-6 sm:p-0 md:pe-0">
                    <input class="shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" type="text" placeholder="City of Residence" name="form-city" id="f-city"/>
                  </div>

                  <div class="col-12 sm:p-0">
                    <select class="form-select shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" name="form-dropdown" id="f-dropdown">
                    <option selected style="color: #adb5bd;">Center Preferred</option>
                      <option value="mumbai">Mumbai</option>
                      <option value="gurgaon">Gurgaon</option>
                      <option value="bangalore">Bangalore</option>
                    </select>
                  </div>
                  <div class="mt-10  d-flex justify-content-center">
                        <button class="btn btn-primary see-more-btn w-45 blue-btn mx-auto" id="f-submit">SUBMIT</button>
                    </div>
        

            </form>

            </div>

        </div>

     </section> -->



     <script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("toggleDelhiContent");
    const moreContent = document.getElementById("delhiCourseMoreContent");

    toggleBtn.addEventListener("click", function () {
      moreContent.classList.toggle("show");

      if (moreContent.classList.contains("show")) {
        toggleBtn.innerText = "Show Less";
      } else {
        toggleBtn.innerText = "Read More";
      }
    });
  });
</script>
<div class="pt-md-15">
  @include('Aboutus::enquiry-form')
</div>
@include('Home::faqs_home')
@include("Courses::partners-courses")
<iframe class="mt-10" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.4022103751827!2d77.0438532!3d28.5877083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1b4755c6dc73%3A0x1be775dc2d702eb9!2sAPCA%20-%20Academy%20of%20Pastry%20%26%20Culinary%20Arts%20%2C%20Delhi%20-%20School%20For%20Baking%20%26%20Culinary%20Arts!5e0!3m2!1sen!2sin!4v1776162433794!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@include('Footer::footer')