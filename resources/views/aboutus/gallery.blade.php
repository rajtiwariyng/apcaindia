@include("Header::header")
<section class="blog-banner hero-banner" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $data['banner']->image) }}');">
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
                      <h2 class="faculty-title">Candid Moments of chefs in action</h2>
                      <p class="faculty-subtitle">Capture candid shots of chefs during service, showcasing their skills and passion in the kitchen.</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
      @endif
    </section>

    <section class="py-12">
      <div class="container px-10">
        <div class="filter-buttons ">
          <button class="filter-btn active" data-category="all">ALL</button>
          <button class="filter-btn" data-category="culinary">CULINARY</button>
          <button class="filter-btn" data-category="pastery">PASTRY</button>
          <button class="filter-btn" data-category="events">EVENT</button>
        </div>
  
         <!-- Gallery -->
        <main class="achivement-gallery pt-md-10">
          @foreach($data['gallery'] as $item)
            <div class="item" data-category="{{ strtolower($item->category) }}">
                <a href="{{ url('public/assets/upload/photogallery/' . $item->image) }}" data-fancybox="gallery">
                    <img class="img" src="{{ url('public/assets/upload/photogallery/' . $item->image) }}" alt="{{ $item->title ?? 'Gallery image' }}">
                </a>
                <div class="caption">
                    <p>{{ $item->caption ?? 'No caption provided.' }}</p>
                </div>
            </div>
            @endforeach
        </main>
      </div>
    </section>

@include('Home::partners')
@include('Footer::footer')