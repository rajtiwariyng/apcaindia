{{-- City centre body (bangalore / gurgaon / mumbai). Content: config/centres.php, courses images resolved in AboutusController::centrePage() --}}
@php $city = ucfirst($cityKey); @endphp
<style>
.centre-courses .course-image { position: relative; overflow: hidden; }
.centre-courses .course-image img { width: 100%; aspect-ratio: 3 / 2; object-fit: cover; display: block; }
.centre-courses .course-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.6); display: flex; align-items: center; justify-content: center; opacity: 0; transition: .3s ease; }
.centre-courses .course-image:hover .course-overlay { opacity: 1; }
.centre-gallery .instructor-image-container img { width: 100%; aspect-ratio: 4 / 3; object-fit: cover; display: block; }
</style>

<!-- Intro -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-6 py-lg-15 py-10">
        <div class="highlight-card">
          <h2 class="title orange fw-medium">{{ $centre['title'] }}</h2>
          <div class="fs-6">
            @foreach($centre['intro'] as $para)
              <p>{{ $para }}</p>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-6 py-lg-15 py-10">
        @if(!empty($centre['video']))
          <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube-nocookie.com/embed/{{ $centre['video'] }}" title="APCA {{ $city }} campus" loading="lazy" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        @elseif(!empty($centre['media_image']))
          <img src="{{ url('/') }}/{{ $centre['media_image'] }}" alt="APCA {{ $city }} campus" class="img-fluid image-fullwidth h-100" loading="lazy">
        @endif
      </div>
    </div>
  </div>
</section>

<!-- Detail sections -->
@foreach($centre['sections'] as $section)
  <section class="container pb-lg-10 pb-8">
    @if(!empty($section['heading']))
      <h2 class="title blue fw-medium mb-5">{{ $section['heading'] }}</h2>
    @endif
    <div class="fs-6">
      @if(!empty($section['list_first']))
        <ul class="ps-6 mb-5">
          @foreach($section['list'] as $item)
            <li class="mb-2">{{ $item }}</li>
          @endforeach
        </ul>
      @endif
      @foreach($section['paras'] as $para)
        <p>{{ $para }}</p>
      @endforeach
      @if(empty($section['list_first']) && !empty($section['list']))
        <ul class="ps-6">
          @foreach($section['list'] as $item)
            <li class="mb-2">{{ $item }}</li>
          @endforeach
        </ul>
      @endif
    </div>
  </section>
@endforeach

<!-- Available courses -->
<section class="courses-section py-lg-15 py-10 apca-programs centre-courses">
  <div class="container">
    <h2 class="title orange mb-5 fw-medium">Available Courses At Academy</h2>
    @if(!empty($centre['courses_intro']))
      <p class="fs-6">{{ $centre['courses_intro'] }}</p>
    @endif
    <div class="mt-10">
      <div class="row g-4">
        @foreach($centre['courses'] as $course)
          <div class="col-lg-4 col-md-6 col-12">
            <a href="{{ url($course['url']) }}">
              <div class="course-card h-100">
                <div class="course-image">
                  <img src="{{ url('/') }}/{{ $course['image'] }}" alt="{{ $course['title'] }}" loading="lazy">
                  <div class="course-overlay">
                    <span style="background:#ff7a00; color:#fff; padding:10px 20px; border-radius:4px; font-weight:600;">See Course Details</span>
                  </div>
                </div>
                <div class="course-content">
                  <h4 class="course-title fs-5-font blue">{{ $course['title'] }}</h4>
                  @foreach($course['lines'] as $line)
                    <p class="mb-1 fs-6">{{ $line }}</p>
                  @endforeach
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Upcoming intakes -->
<section class="container">
  <div class="py-lg-15 py-10">
    <div class="highlight-card">
      <h2 class="title blue fw-medium">Upcoming Intakes</h2>
      <div class="row">
        @foreach($centre['intakes'] as $intake)
          <div class="col-md-6 mb-5">
            <div class="orange fs-4" style="font-weight: 600;">{{ $intake['name'] }}</div>
            <div class="fs-4">{{ $intake['date'] }}</div>
          </div>
        @endforeach
      </div>
      <div class="mt-5">
        <button type="button" class="btn btn-primary see-more-btn w-45 blue-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">APPLY NOW</button>
      </div>
    </div>
  </div>
</section>

<!-- Explore the centre -->
<section class="courses-section py-lg-15 py-10 centre-gallery">
  <div class="container">
    <h2 class="title orange mb-5 fw-medium">Explore Our {{ $city }} Centre</h2>
    <div class="mt-10">
      <div class="row g-4">
        @foreach($centre['gallery'] as $i => $photo)
          <div class="col-md-4 col-6">
            <a href="{{ url('/') }}/{{ $photo }}" data-fancybox="gallery">
              <div class="course-card">
                <div class="instructor-image-container">
                  <img class="instructor-image default-image" src="{{ url('/') }}/{{ $photo }}" alt="APCA {{ $city }} centre photo {{ $i + 1 }}" loading="lazy">
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
