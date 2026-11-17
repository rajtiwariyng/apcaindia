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
                      <h2 class="faculty-title">Awards & Accolades</h2>
                      <p class="faculty-subtitle">Awards & Accolades</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
      @endif
    </section>

    <section class="py-lg-15 py-10">
        <!-- About the Academy -->
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2 class="orange faqUnderline position-relative mb-8" >Awards & Accolades</h2>
              <video width="100%" height="100%" autoplay muted loop playsinline
                class="video-element">
                <source src="{{url('/')}}/assets/upload/pages/{{$data['awards']->video_path}}" type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
          <div class="row pt-15 milestones">
            {!!$data['awards']->content!!}
            <!-- <div class="col-md-6">
              <h2 class="orange pb-6">APCA Growth</h2>
              <ul>
                <li><strong class="blue">2010</strong>: APCA Malaysia</li>
                <li><strong class="blue">2012</strong>: Asia Pastry Forum</li>
                <li><strong class="blue">2015</strong>: APCA India (Gurgaon) & APCA Philippines</li>
                <li><strong class="blue">2017</strong>: APCA Bangalore</li>
                <li><strong class="blue">2018</strong>: APCA India (Mumbai)</li>
                <li><strong class="blue">2019</strong>: APCA Indonesia & APCA Singapore</li>
                <li><strong class="blue">2020</strong>: APCA Chef Online & Enchante Malaysia</li>
                <li><strong class="blue">2023</strong>: Enchante Maldives</li>
              </ul>
            </div>
            <div class="col-md-6">
            <h2 class="orange pb-6">APCA Milestones</h2>
              <ul>
                <li><strong class="blue">2025</strong>: World Pastry Cup 2025 - 3rd Place in the World</li>
                <li><strong class="blue">2024</strong>: Asian Pastry Cup 2024 - 2nd Place</li>
                <li><strong class="blue">2023</strong>: World Pastry Cup 2023 - 6th Place in the World</li>
                <li><strong class="blue">2022</strong>:
                  <ul>
                    <li>Mondial des Arts Sucre 2022 - 3rd Place in the World</li>
                    <li>Asian Pastry Cup 2022 - Champion</li>
                  </ul>
                </li>
                <li><strong class="blue">2019</strong>: World Pastry Cup 2019 - Champion</li>
                <li><strong class="blue">2018</strong>:
                  <ul>
                    <li>Mondial des Arts Sucre 2018 - 2nd Place in the World</li>
                    <li>Asian Pastry Cup 2018 - Champion</li>
                  </ul>
                </li>
                <li><strong class="blue">2017</strong>: World Pastry Cup 2017 - 6th Place in the World</li>
                <li><strong class="blue">2016</strong>:
                  <ul>
                    <li>Mondial des Arts Sucre 2016 - 2nd Place in the World</li>
                    <li>Asian Pastry Cup 2016 - 2nd Place</li>
                  </ul>
                </li>
                <li><strong class="blue">2015</strong>: World Pastry Cup 2015 - 4th Place in the World</li>
                <li><strong class="blue">2014</strong>: Asian Pastry Cup 2014 - Champion</li>
              </ul>
            </div> -->
          </div>
          
        </div>
        
      </section>
      
@include('Home::partners')
@include('Footer::footer')