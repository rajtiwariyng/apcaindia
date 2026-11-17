@include("Header::header")
<?php $segment = Request::segment(1); ?>
<section class="achievment-banner hero-banner" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $data['banner']->image) }}');">
  @if(!empty($data['banner']->video_path))
            <video width="100%" height="100%" autoplay muted loop playsinline class="video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
                <source src="{{ url('/assets/upload/bannervideo/' . $data['banner']->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
      <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative banner-content inner-banner-content">
          <div class="row align-items-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title">Message from director</h2>
                      <p class="faculty-subtitle">At Academy of Pastry and Culinary Arts India (APCA)</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
      @endif
    </section>
    <section>
      <div class="container py-lg-15 py-10">
        <div class="row g-4 pb-10 px-lg-10">
          <div class="col-md-6">
            <div class="highlight-card">
              <h2 class="orange ">{{$data['foundermsg']->title}}</h2>
              {!!$data['foundermsg']->content!!}
              <!-- <p>At APCA, we are passionate about nurturing the next generation of culinary and pastry experts. Our world-class programs are designed to inspire and empower students to excel in the ever-evolving food industry. Whether you're pursuing a career in pastry or culinary arts, our experienced instructors and tailored program provide the perfect environment for you to hone your skills and unleash your creativity.</p>

              <p>Explore our offerings, learn more about our courses, and discover how APCA can help you turn your culinary dreams into reality. Join us and become part of a vibrant community where talent and innovation thrive.</p> -->
              
            </div>
          </div>
          <div class="col-md-6">
            <img src="{{url('/')}}/assets/upload/pages/{{$data['foundermsg']->image}}" alt="foundermsg" class="img-fluid image-fullwidth">
          </div>
        </div>
      </div>
    </section>
@include('Home::partners')
@include('Footer::footer')