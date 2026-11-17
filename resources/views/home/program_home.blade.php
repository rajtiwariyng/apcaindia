<section class="courses-section py-lg-15 py-10 apca-programs">
  <div class="container">
    <div class="px-6 px-lg-0">
      <h2 class="section-title orange blue-md mb-5" data-aos="fade-up">APCA Programs</h2>
      <p class="section-description blue" data-aos="fade-up" data-aos-delay="300">
        Discover our diverse programs, dive into our course offerings, <br>
        and see how APCA can help transform your culinary <br>
        aspirations into a rewarding career.
      </p>
    </div>

    <div class="courses-slider-wrapper position-relative">
      <div class="mt-10">
        <div class="row">
          @foreach ($data['programs'] as $program)
              @php
                // Detect position for mobile layout
                $isFirstTwo = $loop->index < 2;
                // Determine if slug is a full URL
                 $isFullUrl = Str::startsWith($program->slug, ['http://', 'https://']);
                 $programUrl = $isFullUrl ? $program->slug : url('/course/' . $program->slug);
              @endphp
              <div class="col-lg-3 col-md-4 {{ $isFirstTwo ? 'col-12' : 'col-6' }}">
                <a href="{{ $programUrl }}">
                  <div class="course-card">
                    <div class="course-image">
                      <img
                        src="{{ url('/assets/upload/homeprogram/' . $program->image) }}"
                        alt="{{ $program->name }}"
                      />
                    </div>
                    <div class="course-content px-6 px-lg-0">
                      <h3 class="course-category orange text-uppercase">
                        {{ $program->duration }}
                      </h3>
                      <h4 class="course-title blue fs-5-font">{{ $program->name }}</h4>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach

        </div>
      </div>
    </div>
  </div>
</section>
