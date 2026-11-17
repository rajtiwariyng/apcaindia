@include("Header::header")
<section class="faq-banner hero-banner" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $data['banner']->image) }}');">
        @if(!empty($data['banner']->video_path))
            <video width="100%" height="100%" autoplay muted loop playsinline class="video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
                <source src="{{ url('/assets/upload/bannervideo/' . $data['banner']->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
      <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative">
          <div class="row align-items-md-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title top-banner-title">Curious Minds: Faq's</h2>
                      <p class="faculty-subtitle top-banner-subtitle">Each month we receive hundred of inquiries and a wide range of questions. </p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
      @endif
    </section>
      <!-- Community/Alumni Section -->
      <section class="my-15">
        <div class="container">
        <div class="row align-items-center faq-section">
          <div style="width:87%; margin: auto;" class="pb-10">
            <h2 class="blue  position-relative">Frequently Asked Questions</h2>
          </div>
          <div class="col-lg-8 m-auto">
              <div class="accordion" id="faqAccordion1">
                  @foreach($data['faqs'] as $index => $faq)
                      <div class="accordion-item" id="academy-item-{{ $faq->id }}">
                          <h3 class="accordion-header">
                              <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                      type="button"
                                      data-bs-toggle="collapse"
                                      data-bs-target="#academy-faq{{ $faq->id }}"
                                      aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                      aria-controls="academy-faq{{ $faq->id }}">
                                  {{ $index + 1 }}. {{ $faq->question }}
                              </button>
                          </h3>
                          <div id="academy-faq{{ $faq->id }}"
                               class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                               data-bs-parent="#faqAccordion1">
                              <div class="accordion-body">
                                  {!! $faq->answer !!}
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
        </div>
        </div>
        <!-- About the Academy -->
      </section>

@include('Home::partners')

@include('Footer::footer')