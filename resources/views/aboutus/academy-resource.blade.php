@include("Header::header-fixed")
    <section class="explore-banner hero-banner" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $data['banner']->image) }}');">
        @if(!empty($data['banner']->video_path))
            <video width="100%" height="100%" autoplay muted loop playsinline class="video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
                <source src="{{ url('/assets/upload/bannervideo/' . $data['banner']->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
       <!-- <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>-->
      <div class="container position-relative">
          <div class="row align-items-end min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title top-banner-title blue fs-2 fw-medium">Academy Resources</h2>
                  </div>
              </div>
          </div>
      </div>
      <!-- <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>  -->
      @endif
    </section>

     <!-- Community/Alumni Section -->
     <section class="mt-12">
        <div class="container">
            <h2 class="fw-medium blue pb-10">APCA Programs</h2>
            <div class="row">
                <!-- Full Time Programs -->
                <div class="col-md-5">
                    <h2 class="Asection-title">FULL TIME PROGRAMS</h2>
                    @foreach($data['FTPrograms'] as $FTPrograms)
                    <div class="program-container">
                        <h3 class="program-title">{{$FTPrograms->title}}</h3>
                        <a href="/assets/upload/pdf/{{$FTPrograms->pdf_path}}" target="_blank" class="download-link">Download program flyer</a>
                    </div>
                    @endforeach
                    <!-- <div class="program-container">
                        <h3 class="program-title">Advanced Diploma in Culinary Arts</h3>
                        <a href="#" class="download-link">Download program flyer</a>
                    </div>
                    
                    <div class="program-container">
                        <h3 class="program-title">Advanced Diploma Dual Program</h3>
                        <a href="#" class="download-link">Download program flyer</a>
                    </div> -->
                </div>
                
                <!-- Vertical Divider (visible on md and up) -->
                <div class="col-md-1 d-none d-md-flex justify-content-center">
                    <div class="divider h-100"></div>
                </div>
                
                <!-- Short Intensive Programs -->
                <div class="col-md-6">
                    <h2 class="Asection-title">SHORT INTENSIVE PROGRAMS</h2>
                    
                    @foreach($data['STPrograms'] as $STPrograms)
                    <div class="program-container">
                        <h3 class="program-title">{{$STPrograms->title}}</h3>
                        <a href="/assets/upload/pdf/{{$STPrograms->pdf_path}}" target="_blank" class="download-link">Download program flyer</a>
                    </div>
                    @endforeach
                    <!-- <div class="program-container">
                        <h3 class="program-title">24 Days Intensive Pastry Program</h3>
                        <a href="#" class="download-link">Download program flyer</a>
                    </div>
                    
                    <div class="program-container">
                        <h3 class="program-title">2 Weeks Intensive Bakery Program</h3>
                        <a href="#" class="download-link">Download program flyer</a>
                    </div>
                    
                    <div class="program-container">
                        <h3 class="program-title">2 Weeks Intensive Chocolate Program</h3>
                        <a href="#" class="download-link">Download program flyer</a>
                    </div> -->
                </div>
            </div>
            
            <!-- Mobile Divider (visible only on small screens) -->
            <div class="d-md-none">
                <div class="mobile-divider"></div>
            </div>
            
            <!-- Horizontal Divider -->
            <div class="horizontal-divider d-none d-md-block"></div>
            
            <!-- Part-Time Weekend Program -->
            <div class="row">
                <div class="col-md-6">
                    <h2 class="Asection-title">PART-TIME WEEKEND PROGRAM</h2>
                    
                    <div class="program-container">
                        <h3 class="program-title">{{$data['wProgramsf']->title}}</h3>
                        <a href="/assets/upload/pdf/{{$data['wProgramsf']->pdf_path}}" target="_blank" class="download-link">Download program flyer</a>
                    </div>
                </div>
                
                <div class="col-md-6 d-flex align-items-center justify-content-md-end mt-4 mt-md-0">
                    @if(optional($data['wPrograms'])->pdf_path)
                        <a href="/assets/upload/pdf/{{ $data['wPrograms']->pdf_path }}" target="_blank" class="download-link">
                            Download program application form
                        </a>
                    @endif
                </div>
            </div>

            <!-- Intake Schedule Section -->
        <div class="page-section">
            <h2 class="section-heading fw-medium blue pb-5">{{$data['intakecalendar']->title}}</h2>
            <div class="table-container col-md-7">
                {!!$data['intakecalendar']->content!!}
                <!-- <table class="intake-table">
                    <thead>
                        <tr>
                            <th width="30%">Date</th>
                            <th width="70%">Program</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="advanced-diploma-row">
                            <td>January 13</td>
                            <td>Advanced Diploma Programs Intake</td>
                        </tr>
                        <tr>
                            <td>January 13</td>
                            <td>24 Days Intensive Pastry Program Intake</td>
                        </tr>
                        <tr>
                            <td>January 18</td>
                            <td>Part Time Pastry and Bakery Arts Program Intake</td>
                        </tr>
                        <tr>
                            <td>February 10</td>
                            <td>2 Weeks Intensive Chocolate Program Intake</td>
                        </tr>
                        <tr>
                            <td>February 24</td>
                            <td>2 Weeks Intensive Bakery Program Intake</td>
                        </tr>
                        <tr class="advanced-diploma-row">
                            <td>March 10</td>
                            <td>Advanced Diploma Programs Intake</td>
                        </tr>
                        <tr>
                            <td>April 26</td>
                            <td>Part Time Pastry and Bakery Arts Program Intake</td>
                        </tr>
                        <tr>
                            <td>May 5</td>
                            <td>24 Days Intensive Pastry Program Intake</td>
                        </tr>
                        <tr class="advanced-diploma-row">
                            <td>May 19</td>
                            <td>Advanced Diploma Programs Intake</td>
                        </tr>
                        <tr>
                            <td>June 9</td>
                            <td>2 Weeks Intensive Chocolate Program Intake</td>
                        </tr>
                        <tr>
                            <td>June 16</td>
                            <td>2 Weeks Intensive Bakery Program Intake</td>
                        </tr>
                        <tr class="advanced-diploma-row">
                            <td>July 14</td>
                            <td>Advanced Diploma Programs Intake</td>
                        </tr>
                        <tr>
                            <td>July 26</td>
                            <td>Part Time Pastry and Bakery Arts Program Intake</td>
                        </tr>
                        <tr>
                            <td>September 1</td>
                            <td>24 Days Intensive Pastry Program Intake</td>
                        </tr>
                        <tr>
                            <td>October 1-18</td>
                            <td>Asia Pastry Forum 2025</td>
                        </tr>
                        <tr>
                            <td>October 6</td>
                            <td>2 Weeks Intensive Chocolate Program Intake</td>
                        </tr>
                        <tr class="advanced-diploma-row">
                            <td>October 13</td>
                            <td>Advanced Diploma Programs Intake</td>
                        </tr>
                        <tr>
                            <td>October 13</td>
                            <td>2 Weeks Intensive Bakery Program Intake</td>
                        </tr>
                        <tr>
                            <td>October 25</td>
                            <td>Part Time Pastry and Bakery Arts Program Intake</td>
                        </tr>
                    </tbody>
                </table> -->
            </div>
        </div>
        </div>
      </section>

@include('Footer::footer')