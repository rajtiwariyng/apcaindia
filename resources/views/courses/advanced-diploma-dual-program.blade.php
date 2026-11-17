@include("Header::header")
<section class="course-banner hero-banner" style="background-image: url('/assets/images/courses/advanceddiploma-in-culinary/advanceddiploma-in-culinary.jpg');">
      <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative banner-content">
          <div class="row align-items-center min-vh-75">
              <div class="col-lg-9">
                  <div class="content-wrapper" data-aos="fade-right">
                      <div class="banner-title-container">
                        <h2 class="faculty-title">{{$course->title }}</h2>
                      </div>
                      <div class="arts-items pt-10">
                        <div class="item">
                         <img src="{{url('/')}}/assets/images/Icon_Chef.svg" alt="">
                       
                          <p>{{$course->duration }}</p>
                        </div>
                        <div class="item">
                          <img src="{{url('/')}}/assets/images/Icon_DateTime.svg" alt="">
                          <p>{{$course->schedule }}
                          </p>
                        </div>
                        <div class="item big-width">
                          <img src="{{url('/')}}/assets/images/Icon_Certificate.svg" alt="">                          
                          <p>{{$course->certification }}</p>
                        </div>
                        <div class="item big-width">
                          <img src="{{url('/')}}/assets/images/Icon_Internship.svg" alt="">                          
                          <p>{{$course->internship }}
                          </p>
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
    <section class="py-lg-10 main-section">
        <div class="container-fluid">
            <div class="row main-row">
              <div class="col-lg-3 ps-lg-0">
                <div class="courseLeftMenu ps-md-10 pe-md-5" id="sidebar">
                    <h4 class="orange text-uppercase">In this program</h4>
                    <ul>
                        <li><a href="#overview" class="active">Overview</a></li>
                        @foreach($coursemodule as $module)
                            <li><a href="#{{ Str::slug($module->title) }}">{{ $module->title }}</a></li>
                        @endforeach
                        <li><a href="#instructors">Instructors</a></li>
                        <li><a href="#testimonials">Student Testimonials</a></li>
                        <li><a href="#how-to-apply">How to Apply</a></li>
                    </ul>
                  </div>
            </div>

            <div class="col-lg-9 main-container">
                <div class="coursesWrapperRight">
                    <!-- Overview Section (Static) -->
                    <section id="overview">
                        <div class="row pb-md-15">
                            <div class="col-md-4">
                                <div class="pb-md-0 pb-5">
                                    <img src="{{ url('/') }}/assets/upload/coursepage/{{ $course->image }}" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8 ps-md-8 pe-md-10">
                                <div class="courseContent overviewContent">
                                    <h2 class="orange pb-5">Overview</h2>
                                    {!! $course->overview !!}
                                    <ul class="pointers">
                                        <li>
                                            <p class="orange">STRUCTURE</p>
                                            <p>{{ $course->structure }}</p>
                                        </li>
                                        <li>
                                            <p class="orange">CERTIFICATION</p>
                                            <p>{{ $course->certification }}</p>
                                        </li>
                                        <li>
                                            <p class="orange">BONUS UPON GRADUATION</p>
                                            {!! $course->bonus !!}
                                        </li>
                                        <li>
                                            <p class="orange">INTERNATIONAL PAID INTERNSHIP</p>
                                            {!! $course->international_internship !!}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Dynamic Module Sections with Alternating Image Position -->
                    @foreach($coursemodule as $index => $module)
                        <section id="{{ Str::slug($module->title) }}">
                            <div class="row align-items-center {{ $index % 2 == 0 ? 'pb-10 ps-lg-5 pe-lg-10' : 'bgContent ps-lg-5 pe-lg-10' }}">
                                @if($index % 2 == 0)
                                    <!-- Image on Right -->
                                    <div class="col-md-8 ps-md-8 order-md-1 order-2">
                                        <div class="courseContent">
                                            <h2 class="orange pb-5">{{ $module->title }}</h2>
                                            {!! $module->content !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 pt-lg-0 pt-5 pb-lg-0 pb-5 order-md-2 order-1">
                                        <div>
                                            <img src="{{ url('/') }}/assets/upload/coursemodule/{{ $module->image }}" alt="{{ $module->title }}" class="img-fluid">
                                        </div>
                                    </div>
                                @else
                                    <!-- Image on Left -->
                                    <div class="col-md-4 pt-lg-0 pt-5 pb-lg-0 pb-5 order-md-1 order-2">
                                        <div>
                                            <img src="{{ url('/') }}/assets/upload/coursemodule/{{ $module->image }}" alt="{{ $module->title }}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-md-8 ps-md-8 order-md-2 order-1">
                                        <div class="courseContent">
                                            <h2 class="orange pb-5">{{ $module->title }}</h2>
                                            {!! $module->content !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </section>
                    @endforeach

                    <!-- Static Includes -->
                    @include("Courses::chef-courses")
                    <div>
                        <img src="{{ url('/') }}/assets/images/Explore/About-banner-program.jpg" alt="" class="img-fluid">
                    </div>
                    @include("Courses::testimonials-courses")
                    @include("Courses::appointment-form")
                    @include("Courses::partners-courses")
                </div>
            </div>
        </div>
      </div>
    </section>

@include('Footer::footer')