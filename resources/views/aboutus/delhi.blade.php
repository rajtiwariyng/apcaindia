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

    @include('Aboutus::partials.centre-body', ['centre' => $data['centre'], 'cityKey' => 'delhi'])

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