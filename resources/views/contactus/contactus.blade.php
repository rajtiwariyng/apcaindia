@include("Header::header")

    <section class="hero-banner" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $data['banner']->image) }}');">
        @if(!empty($data['banner']->video_path))
            <video width="100%" height="100%" autoplay muted loop playsinline class="video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
                <source src="{{ url('/assets/upload/bannervideo/' . $data['banner']->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
            <div class="blue-overlay">
                <img src="{{ url('/assets/images/apca-pattern.png') }}" alt="">
            </div>
            <div class="container position-relative banner-content inner-banner-content">
                <div class="row align-items-center min-vh-75">
                    <div class="col-lg-6">
                        <div class="content-wrapper" data-aos="fade-right">
                            <h2 class="faculty-title">Contact Us</h2>
                            <p class="faculty-subtitle">Learn from a highly experienced culinary team, in state-of-the-art facilities at India</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-letter" id="backgroundLetter">
                <img src="{{ url('/assets/images/apca-a.png') }}" alt="">
            </div>
        @endif
    </section>

    
    <section class="contact-us py-lg-15 py-10">
      <div class="container">
        <!-- Header -->
        <h2 class="appointment-title mb-8">APPOINTMENT WITH COUNSELLOR</h2>
        
        <!-- Description -->
        <!-- <p class="description-text mb-5">Enter details:</p> -->

        <!-- Form -->
        
        @include("Footer::apform")

        <!-- Centers Section -->
        <div class="row g-4 pt-md-15">
          <!-- First Card -->
            <div class="col-md-4">
            <div class="contact-box center-card left">
            <div class="card-image">
              <img src="{{url('/')}}/assets/images/box-img.png" alt="">
            </div>
            <div class="contact-info">
                <h3 class="text-center mb-4">Gurgaon Campus</h3>
                <div class="info-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>Plot No. 37-38, Udyog Vihar Phase IV, Gurgaon, Haryana</div>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-mobile-screen"></i>
                    <div>+91-844 844 9002</div>
                </div>
                <div class="info-item">
                    <i class="fa-regular fa-envelope"></i>
                    <div>info@apcaindia.com</div>
                </div>
            </div>
            </div>
            </div>

            <div class="col-md-4">
            <div class="contact-box center-card right">
              <div class="card-image">
                <img src="{{url('/')}}/assets/images/box-img.png" alt="">
              </div>
              <div class="contact-info">
                  <h3 class="text-center mb-4">Mumbai Campus</h3>
                  <div class="info-item">
                      <i class="fa-solid fa-location-dot"></i>
                      <div>A Wing, Ground & First Floor, Litolier Chambers, Adjacent to Marol Metro Station, Andheri East, Mumbai</div>
                  </div>
                  <div class="info-item">
                      <i class="fa-solid fa-mobile-screen"></i>
                      <div>+91-844 844 9002</div>
                  </div>
                  <div class="info-item">
                      <i class="fa-regular fa-envelope"></i>
                      <div>info@apcaindia.com</div>
                  </div>
              </div>
            </div>
            </div>

            <div class="col-md-4">
            <div class="contact-box center-card left">
            <div class="card-image">
              <img src="{{url('/')}}/assets/images/box-img.png" alt="">
            </div>
            <div class="contact-info">
                <h3 class="text-center mb-4">Bangluru Campus</h3>
                <div class="info-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>No. 18/2A, Khata No 629/1, Ambalipura, Bellandur Gate, Sarjapur Main Road, Bengaluru East, Karnataka-560102</div>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-mobile-screen"></i>
                    <div>+91-844 844 9002</div>
                </div>
                <div class="info-item">
                    <i class="fa-regular fa-envelope"></i>
                    <div>info@apcaindia.com</div>
                </div>
            </div>
            </div>
            </div>

            <div class="col-md-4">
            <div class="contact-box center-card right">
            <div class="card-image">
              <img src="{{url('/')}}/assets/images/box-img.png" alt="">
            </div>
            <div class="contact-info">
                <h3 class="text-center mb-4">Indonesia Campus</h3>
                <div class="info-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>The Flavor Bliss, Unit FB2 No. 19-20, Jl. Alam Sutera Boulevard, Pakulonan, Serpong Utara, Tangerang Selatan, Banten, 15325, Indonesia.</div>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-mobile-screen"></i>
                    <div>+6221-2531 9064</div>
                </div>
                <div class="info-item">
                    <i class="fa-regular fa-envelope"></i>
                    <div>info@apcaindonesia.com</div>
                </div>
            </div>
            </div>
            </div>

            <div class="col-md-4">
            <div class="contact-box center-card left">
            <div class="card-image">
            <img src="{{url('/')}}/assets/images/box-img.png" alt="">
            </div>
            <div class="contact-info">
              <h3 class="text-center mb-4">Phillipines Campus</h3>
              <div class="info-item">
                  <i class="fa-solid fa-location-dot"></i>
                  <div>Treston International College, University Parkway District, 32nd St. corner C-5 Road, Bonifacio Global City, Taguig, Philippines</div>
              </div>
              <div class="info-item">
                  <i class="fa-solid fa-mobile-screen"></i>
                  <div>+63995 620 1822</div>
              </div>
              <div class="info-item">
                  <i class="fa-regular fa-envelope"></i>
                  <div>info@apcaphilippines.com</div>
              </div>
            </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="contact-box center-card left">
              <div class="card-image">
                <img src="{{url('/')}}/assets/images/box-img.png" alt="">
              </div>
              <div class="contact-info">
                  <h3 class="text-center mb-4">Malaysia Campus</h3>
                  <div class="info-item">
                      <i class="fa-solid fa-location-dot"></i>
                      <div>No. 16, Jalan 51A/223, 46100, Petaling Jaya, Malaysia</div>
                  </div>
                  <div class="info-item">
                      <i class="fa-solid fa-mobile-screen"></i>
                      <div>+603-79603846/45</div>
                  </div>
                  <div class="info-item">
                      <i class="fa-regular fa-envelope"></i>
                      <div>info@apcamalaysia.com</div>
                  </div>
              </div>
            </div>
            </div>
            </div>
    
      </div>
    </section>

@include('Home::partners')
    @include('Footer::footer')

    <script type="text/javascript">
   let submitform = () => {
      let name = $("#name").val();
      let phoneNumber = $("#phone").val();
      let emailid = $("#email").val();
      let organization = 'Apachef';
      let topic = 'Contact-us';
      let message = $("#message").val();
      let country = 'In';

      let mobile_filter = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/;
      let filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

      if (name == "") {
         document.getElementById('name').style.border = '2px solid #ff0000';
         //document.getElementById("name").focus();
         document.getElementById("name").value = '';
         document.getElementById("name").setAttribute("placeholder", "Please enter name");
         document.getElementById("name").classList.add("errors");
         return false;
      } else {
         document.getElementById("name").style.borderColor = "#e1dfdf";
      }

      if (emailid == "") {
         document.getElementById('email').style.border = '2px solid #ff0000';
         document.getElementById("email").focus();
         document.getElementById("email").setAttribute("placeholder", "Please enter your Email Id");
         document.getElementById("email").classList.add("errors");
         return false;
      } else {
         document.getElementById("email").style.borderColor = "";

      }

      if (phoneNumber == "") {
         document.getElementById('phone').style.border = '2px solid #ff0000';
         document.getElementById("phone").focus();
         document.getElementById("phone").value = '';
         document.getElementById("phone").setAttribute("placeholder", "Please enter phone number");
         document.getElementById("phone").classList.add("errors");
         return false;
      }else if(!mobile_filter.test(phoneNumber)){
         $("#phone").val("");
         document.getElementById('phone').style.border = '2px solid #ff0000';
         //document.getElementById("name").focus();
         document.getElementById("phone").value = '';
         document.getElementById("phone").setAttribute("placeholder", "Invalid Contact Number");
         document.getElementById("phone").classList.add("errors");
        return false;
      } else {
         document.getElementById("phone").style.borderColor = "#e1dfdf";
      }

      if (phoneNumber.length != 10) {
         document.getElementById('phone').style.border = '2px solid #ff0000';
         document.getElementById("phone").focus();
         //document.getElementById("phone").value='';
         document.getElementById("phone").setAttribute("placeholder", "Please fill in a valid 10 digits mobile numbe");
         document.getElementById("phone").classList.add("errors");
         return false;

      } else {
         document.getElementById("phone").style.borderColor = "#e1dfdf";

      }



    //   if (organization == "") {
    //      document.getElementById('organization').style.border = '2px solid #ff0000';
    //      document.getElementById("organization").value = '';
    //      document.getElementById("organization").setAttribute("placeholder", "Please enter organization");
    //      document.getElementById("organization").classList.add("errors");
    //      return false;
    //   } else {
    //      document.getElementById("organization").style.borderColor = "#e1dfdf";
    //   }

    //   if (topic == "") {
    //      document.getElementById('topic').style.border = '2px solid #ff0000';
    //      document.getElementById("topic").value = '';
    //      document.getElementById("topic").setAttribute("placeholder", "Please select topic");
    //      document.getElementById("topic").classList.add("errors");
    //      return false;
    //   } else {
    //      document.getElementById("topic").style.borderColor = "#e1dfdf";
    //   }

    if(message=="")
    {        
      document.getElementById('message').style.border='2px solid #ff0000';  
      document.getElementById("message").value='';
      document.getElementById("message").setAttribute("placeholder", "Please enter message");
      document.getElementById("message").classList.add("errors");
      return false;
    }     
   else
    {
      document.getElementById("message").style.borderColor = "#e1dfdf";   
    }

      $("#responseMsg").css("color", "green");
      $("#responseMsg").html('Please wait,validating your request . . .');
      var otpformdata = {
         'name': name,
         'email': emailid,
         'phone': phoneNumber,
         'organization': organization,
         'topic': topic,
         'message': message,
         'country': country
      };

      $.ajax({
         headers: {
            'X-CSRF-Token': '{{ csrf_token() }}'
         },
         type: 'POST',
         url: "{{ url('/contact-us/submit') }}",
         data: otpformdata,
         success: function(response) {
            if (response.status == '200') {
               $("#responseMsg").html('');
               $("#thankYouRespance").css("color", "blue");
               $("#thankYouRespance").html(response.msg + response.referenceno);
               $("#name").val('');
               $("#email").val('');
               $("#organization").val('');
               $("#phone").val('');
               $("#topic").val('');
               $("#message").val('');
               $("#country").val('');
               $('#thankuModal').modal('show');
               setTimeout(function() {
                  $('#thankuModal').modal('hide');
               }, 6000);
            } else {
               $("#responseMsg").css("color", "red");
               $("#responseMsg").html(response.msg);
            }
         }
      });
      return false;


   }
</script>