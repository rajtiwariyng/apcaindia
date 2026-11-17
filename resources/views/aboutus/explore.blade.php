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
      </div>
      <div class="container position-relative">
          <div class="row align-items-md-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title top-banner-title">About us: APCA INDIA</h2>
                      <p class="faculty-subtitle top-banner-subtitle">At Academy of Pastry and Culinary Arts Malaysia (APCA)</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div> -->
        @endif
      
    </section>

     <!-- Community/Alumni Section -->
    <div class="flagBg">
        <section class="container mt-12">
            <div class="row">
                <div class="col-lg-6 text-center">
                    <h2 class="blue">{{$data['apcaMalaysia']->title}}</h2>
                </div>
                <div class="col-lg-6">
                    {!!$data['apcaMalaysia']->content!!}
                    <!-- <p class="section-description">
                        APCA is an internationally acclaimed professional
                            pastry institute, renowned for producing
                            world-class pastry champions.
                    </p>
                    <p>With an exclusive community of celebrated
                        masterchef faculty, a robust international network,
                        opportunities for international internships, in-class
                        hands-on training, well-equipped kitchens – APCA
                        provides you with the ecosystem you need to
                        thrive and be empowered.</p> -->
                    <!-- <button class="btn blue-btn">Brochure Download</button> -->
                </div>
            </div>
        </section>

        <!-- Community/Alumni Section -->
        <section class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 p-0">
                    <img src="{{url('/')}}/assets/upload/pages/{{$data['apcaMalaysia2']->image}}" alt="Students learning culinary skills" class="img-fluid">
                </div>
                <div class="col-lg-6 ps-md-8 ">
                    <h2 class="section-title blue mb-10 position-relative">{{$data['apcaMalaysia2']->title}}</h2>
                    <p class="section-description">
                        {!!$data['apcaMalaysia2']->content!!}
                    <!-- Our mission is to provide world-class pastry
                        and culinary education to our students
                        through a globally relevant curriculum,
                        immersive learning, innovation and
                        technology. -->
                    </p>
                    <!-- <button class="btn blue-btn">Brochure Download</button> -->
                </div>
            </div>
        </section>
    </div>

    <!-- Our Brands Section -->
    <section class="brandsection py-lg-15 py-10">
        <div class="container">
            <h2 class="section-title mb-10 position-relative orange ">Our Brands</h2>
            <!-- <p class="section-description">
                APCA India's website lists its associated brands, including international culinary institutes and culinary centers located across Asia. These brands offer various specialized courses in baking, pastry, and culinary arts, designed to provide global-standard education in the food industry.
            </p> -->
            
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="brand-card ps-0">
                        <img src="{{url('/')}}/assets/images/Explore/layer_48.png" alt="APCA CHEF ONLINE" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="brand-card">
                        <img src="{{url('/')}}/assets/images/Explore/layer_50.png" alt="Enchanté" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="brand-card pe-0">
                        <img src="{{url('/')}}/assets/images/Explore/layer_47.png" alt="Asia Pastry Forum" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
  
      <!-- Accommodation Section -->
      <section class="container my-md-15" id="accommodation">
          <div class="row align-items-center">
              <div class="col-lg-6 p-0">
                  <img src="public/assets/upload/pages/{{$data['apcaMalaysia3']->image}}" alt="Chef preparing food" class="img-fluid">
              </div>
              <div class="col-lg-6 ps-md-10 pt-5 pt-md-0">
                  <h2 class="section-title mb-10 position-relative">Your Career Pathway</h2>
                  {!!$data['apcaMalaysia3']->content!!}
                  <!-- <p class="section-description">
                    A diploma that does more than teach—it
                    transforms.
                  </p>
                  <ul>
                    <li>
                        <p class="orange">Advanced Diploma in Pastry and Bakery Arts</p>
                        <p>Commis, Demi Chef, Pastry Chef, Artisan Baker,
                            Chocolatier, Patisserie Owner, Food Stylist, Dessert
                            Consultant, Product Developer</p>
                    </li>
                    <li>
                        <p class="orange">Advanced Diploma in Culinary Arts</p>
                        <p>Sous Chef, Head Chef, Culinary Consultant, Restaurant
                        Manager, F&B Entrepreneur, Private Chef</p>
                    </li>
                  </ul> -->
              </div>
          </div>
      </section>
      <!-- Industrial Visits Section -->
      <section class="container-fluid my-md-15" id="industrial-visit">
        <div class="row">
            <div class="col-lg-6 ps-md-16 pe-md-10 order-md-1 order-2 pt-5 pt-md-0">
                <h2 class="section-title mb-10 position-relative">Job Opportunities</h2>
                
                <div class="introduction-text">
                    {!!$data['apcaMalaysia4']->content!!}
                    <!-- <p>At APCA, our reputation attracts chefs from
                        5-star hotels, renowned restaurants, and top
                        bakeries—many of whom train with us and
                        actively hire our graduates. You’ll find APCA
                        alumni working in leading hospitality brands
                        across major cities and international destinations.</p>
                    
                    <p>As you approach the final phase of your diploma,
                        we provide hands-on guidance in
                        entrepreneurship, costing, and setting up your
                        own bakery or restaurant—ideal for students
                        planning to launch their own ventures.</p>
                    <p>To support career placement, we begin sharing
                        your resume with our network of employers six
                        weeks before graduation. Interviews and skill
                        tests are arranged, giving you a head start in the
                        industry—even before you complete your
                        program.</p> -->
                </div>
            </div>
            <div class="col-lg-6 p-0 order-md-2 order-1">
                <img src="public/assets/upload/pages/{{$data['apcaMalaysia4']->image}}" alt="Chef preparing ingredients" class="img-fluid chef-image w-100">
            </div>
        </div>
      </section>

@include('Home::partners')

<section class="sponsors py-10 pb-md-15">
    <div class="container">
    <h2 class="section-title  mb-0 position-relative orange">Sponsoring & Supporting Brands</h2>
        <div class="row align-items-center pt-8" >
             @foreach($data['supportingbrands'] as $brands)
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/upload/supportingbrands/{{ $brands->image }}" alt="" class="img-fluid">
                </div>
            </div>
            @endforeach
            <!-- <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/bidfood_logo_scaled.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/Callebaut_Logo.svg" alt="" class="img-fluid">
                </div>
            </div>
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/Fonterra_Logo.svg" alt="" class="img-fluid">
                </div>
            </div>
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/ChefArt_Logo.png" alt="" class="img-fluid w-50">
                </div>
            </div>
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/Silikomart_Logo.svg" alt="" class="img-fluid">
                </div>
            </div>
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/friulinox_logo.svg" alt="" class="img-fluid">
                </div>
            </div>
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/Unox-Logo.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/Carpigiani_Logo.svg" alt="" class="img-fluid">
                </div>
            </div>
            <div class="sponsor-brand">
                <div>
                    <img src="{{url('/')}}/assets/images/sponsors/FBM-boscolo_Logo.png" alt="" class="img-fluid">
                </div>
            </div> -->
        </div>
    </div>
</section>

@include('Footer::footer')