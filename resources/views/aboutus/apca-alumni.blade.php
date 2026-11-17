@include("Header::header")
<section class="faculty-hero hero-banner" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $data['banner']->image) }}');">
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
                      <h2 class="faculty-title">Alumni</h2>
                      <p class="faculty-subtitle">APCA India: Cultivating Talents and Celebrating Success</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
      @endif
    </section>
    <!-- Hero Section -->
    <section class="instructors-section py-15">
      <div class="container">
        <h2 class="section-title">Alumni</h2>
        <p class="section-description mb-5">
          APCA India: Cultivating Talents and Celebrating Success
        </p>

        <div class="row g-4">
           @foreach($data['alumnies'] as $alumni)
          <div class="col-lg-4 col-md-6 col-6">
              <div class="instructor-image-container">
                <img
                  src="{{ url('/') }}/assets/upload/alumni/{{ $alumni->image ?? 'placeholder.jpg' }}"
                  alt=" "
                  class="instructor-image default-image"
                />
                
              </div>
              <div class="instructor-info">
                <h3 class="instructor-name">{{ $alumni->name }}</h3>
                <p class="instructor-title">
                 {!! $alumni->designation !!}
                </p>
              </div>
          </div>
          @endforeach
          
              <!-- <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/alumni/Tan-Wei-Loon.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Tan Wei Loon</h3>
                  <p class="instructor-title">
                   Cofounder of Enchante Patisserie <br>Coupe Du Monde De La Patisserie, Champion of 2019

                  </p>
                </div>
              </div>
          
              <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/alumni/Loi-Ming-Ai.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Loi Ming Ai</h3>
                  <p class="instructor-title">
                   Cofounder of Voila Patisserie <br>Coupe Du Monde De La Patisserie, Champion of 2019


                  </p>
                </div>
              </div>
        
          
              <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/alumni/Lim-Wei-Hrn.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Lim Wei Hrn</h3>
                  <p class="instructor-title">
                   Pastry Chef at Wakuda At Marina Bay Sands


                  </p>
                </div>
              </div>
      
          
              <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/alumni/Foo-Yi-Qing.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Foo Yi Qing</h3>
                  <p class="instructor-title">
                   Pastry Chef at APCA India<br>Coupe Du Monde De La Patisserie, Third Rank 2022<br>Asia Pastry Cup 2024, Silver


                  </p>
                </div>
              </div>
          
              <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/alumni/Lawrence-Cheong.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Lawrence Cheong</h3>
                  <p class="instructor-title">
                   Cofounder of C3-Lab<br>Masterchef at Asia Pastry Forum


                  </p>
                </div>
              </div>
          
              <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/alumni/Chong-Ko-Wai.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chong Ko Wai</h3>
                  <p class="instructor-title">
                   Cofounder of C3-Lab


                  </p>
                </div>
              </div>
          
              <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/placeholder.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Ahmad Amirul Imran Bin Muhd Kamil</h3>
                  <p class="instructor-title">
                  Asian Specialty Chef <br>Holiday Villa Hotels And Resorts, Ha’il, Saudi Arabia



                  </p>
                </div>
              </div>
          
              <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/placeholder.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Lim Qi Zhi</h3>
                  <p class="instructor-title">
                  Chef de Partie<br>Fairmont Singapore ANTI:DOTE
                  </p>
                </div>
              </div>
          
              <div class="col-lg-4 col-md-6">
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/placeholder.jpg"
                    alt=" "
                    class="instructor-image default-image"
                  />
                  
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Alex Loh King Mun</h3>
                  <p class="instructor-title">
                  Sous Chef at Troika Sky Dining KLCC
                  </p>
                </div>
              </div> -->
        </div>
      </div>






    </section>

@include('Home::partners')
@include('Footer::footer')
