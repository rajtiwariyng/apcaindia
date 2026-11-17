@include("Header::header")

<section class="faculty-hero hero-banner" style="background-image: url('{{ url('/assets/upload/bannervideo/' . $data['banner']->image) }}');">
        @if(!empty($data['banner']->video_path))
            <video width="100%" height="100%" autoplay muted loop playsinline class="video-element" oncanplaythrough="this.previousElementSibling.style.display='none'">
                <source src="{{ url('/assets/upload/bannervideo/' . $data['banner']->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
    <div class="blue-overlay">
        <img src="{{ url('/') }}/assets/images/apca-pattern.png" alt="">
    </div>
    <div class="container position-relative banner-content inner-banner-content">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6">
                <div class="content-wrapper" data-aos="fade-right">
                    <h2 class="faculty-title text-uppercase">MEET our Chefs Team</h2>
                    <p class="faculty-subtitle">Learn from a highly experienced culinary team, in state-of-the-art facilities at India,</p>
                </div>
            </div>
        </div>
    </div>
    <div class="background-letter" id="backgroundLetter">
        <img src="{{ url('/') }}/assets/images/apca-a.png" alt="">
    </div>
    @endif
</section>

<!-- Hero Section -->
<section class="instructors-section py-lg-15 py-10">
    <div class="container">
        <h2 class="section-title">Chef Educators</h2>
        <p class="section-description mb-5">
            Learn from our Master Chefs and gain the global experience
        </p>

        <div class="row g-4">
            @foreach($data['chefeducators'] as $chef)
                <div class="col-lg-4 col-md-6">
                    <div class="instructor-card" data-bs-toggle="modal" data-bs-target="#chef-{{ str_replace(' ', '-', $chef->name) }}Modal">
                        <div class="instructor-image-container">
                            <img src="{{ url('/') }}/assets/upload/chefeducators/{{ $chef->image ?? 'placeholder.jpg' }}" alt="{{ $chef->name }}" class="instructor-image default-image" />
                            <img src="{{ url('/') }}/assets/upload/chefeducators/{{ $chef->image ?? 'placeholder.jpg' }}" alt="{{ $chef->name }}" class="instructor-image hover-image" />
                        </div>
                        <div class="instructor-info">
                            <h3 class="instructor-name">{{ $chef->name }}</h3>
                            <p class="instructor-title">{{ $chef->designation }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Dynamic Modals -->
    @foreach($data['chefeducators'] as $chef)
        <div class="modal facultyModal fade" id="chef-{{ str_replace(' ', '-', $chef->name) }}Modal" tabindex="-1" aria-labelledby="chef-{{ str_replace(' ', '-', $chef->name) }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="{{ url('/') }}/assets/images/faculty/close.png" alt="" />
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ url('/') }}/assets/upload/chefeducators/{{ $chef->image ?? 'placeholder.jpg' }}" alt="{{ $chef->name }}" class="img-fluid" />
                                <div class="social-links mt-3">
                                    @if(!empty($chef->facebook))
                                        <a href="{{ $chef->facebook }}" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
                                    @endif
                                    @if(!empty($chef->insta))
                                        <a href="{{ $chef->insta }}" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7 info-container">
                                <h2 class="modal-title" id="chef-{{ str_replace(' ', '-', $chef->name) }}ModalLabel">{{ $chef->name }}</h2>
                                <h5 class="chef-title orange">{{ $chef->designation }}</h5>
                                <p class="chef-bio">{!! $chef->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>

@include('Home::partners')
@include('Footer::footer')