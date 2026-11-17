@include("Header::header")
<section class="blog-banner hero-banner" style="background-image: url('/assets/upload/intprogram_page/{{$blog->image}}')">
      <!-- <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative">
          <div class="row align-items-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title">BLOGS</h2>
                      <p class="faculty-subtitle">Lorem ipsum dolor sit amet consectetur, adipisicing elit. In non pariatur libero suscipit sit laborum obcaecati nostrum sapiente est quae. </p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div> -->
    </section>

    <section>
      <div class="container py-lg-15 py-10">
        <div class="row g-4 pb-10 px-lg-10">
          <div class="col-md-12">
            <div class="highlight-card">
              <h2 class="orange ">{{$blog->title}}</h2>
              {!!$blog->description!!}
              
            </div>
          </div>
        </div>
      </div>
    </section>
@include('Home::partners')
@include('Footer::footer')