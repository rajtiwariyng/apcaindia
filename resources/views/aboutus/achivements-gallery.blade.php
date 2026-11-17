@include("Header::header")
<?php $segment = Request::segment(1); ?>
<section class="banner">
      <img src="{{url('/')}}/assets/images/blog/layer_3.jpg" alt="" class="img-fluid" />
    </section>

    <section class="py-15">
      <div class="container px-10">
        <div class="info-achivement">
          <h2 class="orange">India Pastry Cup 2023: A Journey Through Culinary
            Artistry and Innovation in the World of Pastry</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus dolorum ipsum modi a? Porro, dolores possimus. Maiores mollitia repellat exercitationem quas dolorum odit, praesentium culpa ipsam optio ipsa adipisci quae ullam quidem ipsum veniam. Ad possimus laudantium dolorum dicta quasi impedit, harum illum magnam quas rerum provident. Quaerat eaque blanditiis quam obcaecati vero. </p>
        </div>
        <main class="achivement-gallery pt-md-10">
          <div class="item item-1">
            <a href="{{url('/')}}/assets/images/achivements/rectangle_4.png" data-fancybox="gallery">
              <img class="img" src="{{url('/')}}/assets/images/achivements/rectangle_4.png" alt="">
            </a>
          </div>
          <div class="item item-2">
            <a href="{{url('/')}}/assets/images/achivements/rectangle_4_copy.png" data-fancybox="gallery">
              <img class="img" src="{{url('/')}}/assets/images/achivements/rectangle_4_copy.png" alt="">
            </a>
          </div>
          <div class="item item-3">
            <a href="{{url('/')}}/assets/images/achivements/rectangle_4_copy_5_2.png" data-fancybox="gallery">
              <img class="img" src="{{url('/')}}/assets/images/achivements/rectangle_4_copy_5_2.png" alt="">
            </a>
          </div>
          <div class="item item-4">
            <a href="{{url('/')}}/assets/images/achivements/rectangle_4_copy_4.png" data-fancybox="gallery">
              <img class="img" src="{{url('/')}}/assets/images/achivements/rectangle_4_copy_4.png" alt="">
            </a>
          </div>
          <div class="item item-5">
            <a href="{{url('/')}}/assets/images/achivements/rectangle_4_copy_5_3.png" data-fancybox="gallery">
              <img class="img" src="{{url('/')}}/assets/images/achivements/rectangle_4_copy_5_3.png" alt="">
            </a>
          </div>
          <div class="item item-6">
            <a href="{{url('/')}}/assets/images/achivements/rectangle_4_copy_2.jpg" data-fancybox="gallery">
              <img class="img" src="{{url('/')}}/assets/images/achivements/rectangle_4_copy_2.jpg" alt="">
            </a>
          </div>
          <div class="item item-7">
            <a href="{{url('/')}}/assets/images/achivements/rectangle_2_2.png" data-fancybox="gallery">
              <img class="img" src="{{url('/')}}/assets/images/achivements/rectangle_2_2.png" alt="">
            </a>
          </div>
          <div class="item item-8">
            <a href="{{url('/')}}/assets/images/achivements/rectangle_4_copy_3.png" data-fancybox="gallery">
              <img class="img" src="{{url('/')}}/assets/images/achivements/rectangle_4_copy_3.png" alt="">
            </a>
          </div>
      
        </main>
      </div>
      
    </section>

    <section class="partners-section">
      <div class="container pb-15">
        <h2 class="section-title">Placement Partners</h2>
        <p class="section-description mb-5">
          Lorem ipsum dolor sit amet, consectetuer<br />adipiscing elit, sed
          diam nonummy nibh euismod.
        </p>

        <div class="position-relative partner-slider pt-10">
          <div class="swiper partnersSwiper">
            <div class="swiper-wrapper">
              <!-- Partner 1 -->
              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/17.png"
                    alt="Taj Hotels"
                    class="img-fluid"
                  />
                </div>
              </div>

              <!-- Partner 2 -->
              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/18.png"
                    alt="JW Marriott"
                    class="img-fluid"
                  />
                </div>
              </div>

              <!-- Partner 3 -->
              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/19.png"
                    alt="The Leela"
                    class="img-fluid"
                  />
                </div>
              </div>

              <!-- Additional partners for continuous loop -->
              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/17.png"
                    alt="The Oberoi"
                    class="img-fluid"
                  />
                </div>
              </div>

              <div class="swiper-slide">
                <div class="partner-logo">
                  <img
                    src="{{url('/')}}/assets/images/home/18.png"
                    alt="ITC Hotels"
                    class="img-fluid"
                  />
                </div>
              </div>
            </div>
          </div>
          <!-- Navigation buttons -->
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>

        <div class="text-center mt-10">
          <button class="btn btn-primary blue-btn">SEE MORE</button>
        </div>
      </div>
    </section>
@include('Footer::footer')
