<section class="courses-section offered-courses position-relative pb-10" id="instructors">
    <div class="">
      <h2 class="section-title orange ps-md-11">Chef Educators </h2>
      

      <!-- Swiper -->
      <div class="courses-slider-wrapper coursePageSlider position-relative">
        <div class="swiper coursesSwiper instructorSwiper mt-10">
          <div class="swiper-wrapper">
            <!-- Slide 1 -->
             @foreach($data['chefeducators'] as $chef)
            <div class="swiper-slide">
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

            <!-- <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefYogeshModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Tan-Wei-Loon.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Tan-Wei-Loon.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Tan Wei Loon</h3>
                  <p class="instructor-title">World Pastry Champion</p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefYogeshModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Lim-Chin-Kheng.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Lim-Chin-Kheng.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Lim Chin Kheng</h3>
                  <p class="instructor-title">Director of Pastry Studies</p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefYogeshModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Charles-Lim.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Charles-Lim.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Charles Lim</h3>
                  <p class="instructor-title">Executive Pastry Chef </p>
                </div>
              </div>
            </div>

            <3!-- Slide 2 --9>
            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefJagadishModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Mun-Pui-Teng.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Mun-Pui-Teng.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Mun Pui Teng</h3>
                  <p class="instructor-title">
                  Executive Pastry Chef                          </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefJagadishModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Foo-Yi-Qing.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Foo-Yi-Qing.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Foo Yi Qing</h3>
                  <p class="instructor-title">
                  Pastry Chef                             </p>
                </div>
              </div>
            </div>


            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefJagadishModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Edison-Lee.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Edison-Lee.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Edison Lee Yung Hoe </h3>
                  <p class="instructor-title">
                  Pastry Chef                             </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefJagadishModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Deanna-Rahman.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Deanna-Rahman.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Deanna Rahman</h3>
                  <p class="instructor-title">
                  Pastry Chef                             </p>
                </div>
              </div>
            </div>


            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefYogeshModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Thaddaeus-Pio-Vellu.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Thaddaeus-Pio-Vellu.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Thaddeus Vio Pellu</h3>
                  <p class="instructor-title">Pastry Chef and Master Chef Artistic</p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefYogeshModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Kashish-Sharma.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Kashish-Sharma.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Kashish Sharma</h3>
                  <p class="instructor-title">Assistant Pastry Chef </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefYogeshModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/placeholder.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/placeholder.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Tiffany Gail Rajayah</h3>
                  <p class="instructor-title">Assistant Pastry Chef </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefYogeshModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Ahmed.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Ahmed.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Ahmad Haidzir</h3>
                  <p class="instructor-title">Director of Culinary Studies </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div
                class="instructor-card"
                data-bs-toggle="modal"
                data-bs-target="#chefYogeshModal"
              >
                <div class="instructor-image-container">
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Fauzan.jpg"
                    alt="Chef Niklesh Sharma"
                    class="instructor-image default-image"
                  />
                  <img
                    src="{{url('/')}}/assets/images/faculty/Chef-Fauzan.jpg"
                    alt="Chef Niklesh Sharma Cooking"
                    class="instructor-image hover-image"
                  />
                </div>
                <div class="instructor-info">
                  <h3 class="instructor-name">Chef Fauzan Martin</h3>
                  <p class="instructor-title">Chef de Cuisine</p>
                </div>
              </div>
            </div> -->

            
          </div>
        </div>
        <div class="swiper-pagination"></div>
        <!-- Navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
    
  </section>