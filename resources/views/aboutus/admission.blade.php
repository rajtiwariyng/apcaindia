@include("Header::header")
<section class="faq-banner hero-banner" style="background-image: url('./assets/images/FAQs/layer_3.jpg')">
      <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative">
          <div class="row align-items-md-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title top-banner-title">Admission</h2>
                      <p class="faculty-subtitle top-banner-subtitle">Admission</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
    </section>
      <!-- Community/Alumni Section -->
      <section class="container-fluid my-15">
        <!-- About the Academy -->
        <div class="row align-items-center faq-section">
          <div class="col-lg-6 ps-md-15 pe-md-10">
            <h2 class="orange faqUnderline position-relative">Admission</h2>
            <!-- Description -->

          </div>
        </div>
      </section>

      <section class="contact-us py-lg-15 py-10">
        <div class="container">
          <!-- Header -->
          <h2 class="appointment-title mb-8">Admission Enquiry Form</h2>

          <!-- Short description under form heading -->
          <p class="description-text mb-5">
            Have questions about course eligibility, fees, start dates, or accommodations? Fill out the form below and our admissions team will get in touch with you shortly. We're here to help you make the best decision for your culinary future.
          </p>

          @include("Footer::apform")
        </div>
      </section>




@include('Footer::footer')