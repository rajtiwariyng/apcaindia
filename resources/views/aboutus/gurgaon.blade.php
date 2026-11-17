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
</style>

    <section class="explore-banner hero-banner"style="background-image: linear-gradient(to right, rgba(147, 147, 152, 0.55) 0%, rgba(147, 147, 152, 0.55) 30%, rgba(147, 147, 152, 0.01) 100%), url('{{ url('/assets/upload/bannervideo/' . $image) }}');">
          @if(!empty($data['banner']->video_path))
              <video width="100%" height="100%" autoplay muted loop playsinline class="video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
                  <source src="{{ url('/assets/upload/bannervideo/' . $data['banner']->video_path) }}" type="video/mp4">
                  Your browser does not support the video tag.
              </video>
          @else
        <!-- <div class="blue-overlay">
          <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
        </div>-->
        <div class="container position-relative d-flex justify-content-center align-items-center h-100">
            <div class="d-flex flex-row-reverse my-auto">
                <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center px-5 py-8 lg:px-10 lg:py-12 rounded" style="background-color: rgba(215, 215, 225, 0.7);">
                    <h2 class="title blue fw-semibold mb-2 mb-lg-10 text-center">
                    Send Us Your Enquiry
                    </h2>
                    <form class="row g-3 g-md-5 w-100">
                        <div class="col-6">
                          <input class="shadow-none border-0 outline-none px-5 py-2 lg:py-3 col-12" style="background-color: #edeef3;" type="text" placeholder="Name" name="form-t-name" id="f-t-name"/>
                        </div>

                        <div class="col-6">
                          <input class="shadow-none border-0 outline-none px-5 py-2 lg:py-3 col-12" style="background-color: #edeef3;" type="tel" placeholder="Phone" name="form-t-phone" id="f-t-phone"/>
                        </div>

                        <div class="col-6">
                          <input class="shadow-none border-0 outline-none px-5 py-2 lg:py-3 col-12" style="background-color: #edeef3;" type="email" placeholder="Email Id" name="form-t-email" id="f-t-email"/>
                        </div>

                        <div class="col-6">
                          <input class="shadow-none border-0 outline-none px-5 py-2 lg:py-3 col-12" style="background-color: #edeef3;" type="text" placeholder="City of Residence" name="form-t-city" id="f-t-city"/>
                        </div>

                        <div class="col-12">
                          <select class="form-t-select shadow-none border-0 outline-none px-5 py-2 lg:py-3 col-12" style="background-color: #edeef3;" name="form-t-dropdown" id="f-dropdown">
                          <option selected style="color: #adb5bd;">Center Preferred</option>
                            <option value="delhi">Delhi</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="gurgaon">Gurgaon</option>
                            <option value="bangalore">Bangalore</option>
                          </select>
                        </div>
                        <div class="mt-5 mt-lg-10 d-flex justify-content-center">
                              <button class="btn btn-primary see-more-btn w-45 blue-btn mx-auto" id="f-t-submit">SUBMIT</button>
                          </div>
              

                    </form>
                </div>

                <div class="d-none d-md-block col-lg-6 d-flex flex-column align-items-center justify-content-center p-5 lg:p-10 ">

                <h1 class="title blue fw-semibold text-center">

                ELEVATE YOUR CULINARY JOURNEY

                </h1>

                <p class="title blue fw-semibold text-center mt-10">
                Connect with APCA Chef to explore world-class culinary training, expert mentorship, and opportunities that shape your future in the global kitchen.
                Share your details and let APCA Chef guide you toward a successful career in culinary arts with internationally recognized programs.
                </p>

                </div>
            </div>
        </div>
        <!-- <div class="background-letter" id="backgroundLetter">
          <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
        </div>  -->
        @endif
    </section>

     <!-- Baking & Pastry Courses Section -->
     <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6 py-lg-15 py-10">
            <div class="highlight-card">
              <h2 class="title orange fw-medium">Baking & Pastry Courses in Gurgaon</h2>

                <div class="fs-6">

              <p>
              Welcome to APCA Gurgaon – the ultimate destination for culinary enthusiasts! Explore our top-notch baking classes in Gurgaon and chef courses in Delhi NCR, where excellence meets a vibrant, innovative atmosphere. Established in March 2015 amidst the thriving hub of Cyber City, our branch stands out as a beacon for aspiring chefs seeking an unparalleled pastry and culinary education experience.
              </p>
              <p>
              APCA Gurgaon offers aspiring chefs top-tier culinary training. Located in Gurgaon, the academy provides comprehensive courses in culinary fundamentals, advanced techniques, pastry arts, international cuisines, and modern kitchen practices.
              </p>

              <p>
              Skilled chef instructors, state-of-the-art facilities, and a globally aligned curriculum offer hands-on experience through live kitchen sessions, workshops, and industry projects. APCA Gurgaon creates an ideal environment for both beginners and professionals to learn, innovate, and grow their culinary careers.
              </p>

              <p>
              With an emphasis on practical learning, students build confidence and skill in all areas of culinary arts. From knife skills and sauce making to baking and pastry design, APCA Gurgaon prepares graduates with the tools needed to succeed in a competitive culinary industry. The academy also highlights the importance of hygiene, safety, and efficient kitchen management, ensuring students are ready for the demands of a professional kitchen.
              </p>

              <p>
              Whether aspiring to open their own restaurant, work in a five-star hotel, or become a renowned pastry chef, APCA Gurgaon provides a strong foundation for a successful and rewarding culinary journey.
              </p>

                <div class=" mt-10">
                    <a href="" class="btn btn-primary see-more-btn w-45 blue-btn">LEARN MORE</a>
                </div>
  
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
    <section class="courses-section py-lg-15 py-10 apca-programs" >
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
      <div class="py-lg-15 py-10">
        <div class="row g-4 justify-content-center align-items-center">
        <div class="col-md-6 h-100">
            <img src="{{url('/')}}/assets/upload/homeslider/6933e6486fa4a_2.jpg" alt="foundermsg" class="img-fluid image-fullwidth h-100">
          </div>
          <div class="col-md-6 ps-10">
            <div class="highlight-card">
              <h2 class="title blue fw-medium">Upcoming Intakes</h2>

              <div class="row justify-content-center align-items-center">
                <!-- Intake - 1 -->
                  <div class="row col-12">

                    <div class="col-12 orange fs-4" style="font-weight: 600;">
                      Full Time Pastry & Bakery
      
                    </div>

                    <div class="fs-4">
                      17th August 2026
                    </div>
                  </div>
                <!-- Intake - 2 -->
                  <div class="row col-12">

                    <div class="col-12 orange fs-4" style="font-weight: 600;">
                      Full Time Culinary
                    </div>

                    <div class="fs-4">
                      18th May 2026
                    </div>
                  </div>
                <!-- Intake - 3 -->
                  <div class="row col-12">

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
    <section class="courses-section py-lg-15 py-10" >
      <div class="container">
        <div class="">
          <!-- <h2 class=" title blue mb-5 fw-medium">Exciting global experience available after completion of the Advanced Diplomaprograms, and it is optional.</h2> -->
          <h2 class="title orange mb-5 fw-medium">Explore Our Gurgaon Centre</h2>
          
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
     <section class="container">

        <div class="d-flex flex-column py-lg-15 py-10">

            <h2 class="title blue fw-medium mb-10">
            Request A Call Back
            </h2>

            <div class="flex flex-col">

            <form class="row g-5 w-100">
                  <div class="col-12 col-md-6">
                    <input class="shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" type="text" placeholder="Name" name="form-name" id="f-name"/>
                  </div>

                  <div class="col-12 col-md-6">
                    <input class="shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" type="tel" placeholder="Phone" name="form-phone" id="f-phone"/>
                  </div>

                  <div class="col-12 col-md-6">
                    <input class="shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" type="email" placeholder="Email Id" name="form-email" id="f-email"/>
                  </div>

                  <div class="col-12 col-md-6">
                    <input class="shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" type="text" placeholder="City of Residence" name="form-city" id="f-city"/>
                  </div>

                  <div class="col-12">
                    <select class="form-select shadow-none border-0 outline-none px-5 py-3 col-12" style="background-color: #edeef3;" name="form-dropdown" id="f-dropdown">
                      <option selected style="color: #adb5bd;">Center Preferred</option>
                      <option value="delhi">Delhi</option>
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

     </section>

@include('Home::faqs_home')
@include('Home::partners')
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3506.507967374905!2d77.08174!3d28.494360999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d193e530d2b09%3A0xad08e4f0c3902744!2sAPCA%20-%20Academy%20of%20Pastry%20%26%20Culinary%20Arts%20%2C%20Gurgaon%20Delhi%20NCR%20-%20School%20For%20Baking%20%26%20Culinary%20Arts!5e0!3m2!1sen!2sus!4v1776666933947!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@include('Footer::footer')