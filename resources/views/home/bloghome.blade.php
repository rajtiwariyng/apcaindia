<section class="blog-section py-lg-15 py-10">
      <div class="container">
        <h2 class="section-title mb-lg-10 mb-0 text-lg-start text-center">APCA Blog</h2>
        <div class="row g-4">
           <!-- Swiper -->
          <div class="blogs-slider-wrapper position-relative">
            <div class="swiper homeBlogsSwiper mt-10">
              <div class="swiper-wrapper">
                @foreach($data['blogs'] as $blog)
                <!-- Slide 1 -->
                <div class="swiper-slide">
                  <a href="{{url('/')}}/blog/{{$blog->slug}}">
                    <div class="blog-card">
                      <div class="blog-image">
                        <img
                          src="{{url('/')}}/assets/upload/blog/{{$blog->image}}"
                          alt="Bakery Tips"
                          class="img-fluid"
                        />
                      </div>
                      <div class="blog-content">
                        <h3 class="blog-title">{{ucfirst(substr($blog->title, 0, 30))}}</h3>
                        <p class="blog-description">
                          {!!substr($blog->blog_short_desc, 0, 110)!!}...
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
                @endforeach
                <!-- Slide 2 -->
                <!-- <div class="swiper-slide">
                  <a href="{{url('/')}}/blog-details">
                    <div class="blog-card">
                      <div class="blog-image">
                        <img
                          src="{{url('/')}}/assets/images/home/14.png"
                          alt="Bakery Tips"
                          class="img-fluid"
                        />
                      </div>
                      <div class="blog-content">
                        <h3 class="blog-title">The Benefits of APCA Malaysia's Part-Time Pastry Courses</h3>
                        <p class="blog-description">
                          Baking at home is a rewarding experience, but turning a passion for pastry into a professional skill set requires expert guidance and structured learning.
                        </p>
                      </div>
                    </div>
                  </a>
                </div> -->
                <!-- Slide 3 -->
               <!--  <div class="swiper-slide">
                  <a href="{{url('/')}}/blog-detail">
                    <div class="blog-card">
                      <div class="blog-image">
                        <img
                          src="{{url('/')}}/assets/images/home/15.png"
                          alt="Bakery Tips"
                          class="img-fluid"
                        />
                      </div>
                      <div class="blog-content">
                        <h3 class="blog-title">Inside APCA Malaysia's Advanced Diploma in Culinary Arts</h3>
                        <p class="blog-description">
                          A true culinary artist is made through passion, precision, and expert training. At APCA Malaysia (Academy of Pastry & Culinary Arts Malaysia), aspiring chefs receive world-class education through the Advanced Diploma in Culinary Arts
                        </p>
                      </div>
                    </div>
                  </a>
                </div> -->

                <!-- <div class="swiper-slide">
                  <a href="{{url('/')}}/blog-details">
                    <div class="blog-card">
                      <div class="blog-image">
                        <img
                          src="{{url('/')}}/assets/images/home/13.png"
                          alt="Bakery Tips"
                          class="img-fluid"
                        />
                      </div>
                      <div class="blog-content">
                        <h3 class="blog-title">Bakery Tips</h3>
                        <p class="blog-description">
                          Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                          diam
                        </p>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="{{url('/')}}/blog-details">
                    <div class="blog-card">
                      <div class="blog-image">
                        <img
                          src="{{url('/')}}/assets/images/home/13.png"
                          alt="Bakery Tips"
                          class="img-fluid"
                        />
                      </div>
                      <div class="blog-content">
                        <h3 class="blog-title">Bakery Tips</h3>
                        <p class="blog-description">
                          Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                          diam
                        </p>
                      </div>
                    </div>
                  </a>
                </div> -->
              </div>
            </div>
          </div>
        </div>
        <div class="text-center mt-10">
          <a href="{{url('/')}}/blog" class="btn btn-primary see-more-btn blue-btn">
            SEE MORE
          </a>
        </div>
      </div>
    </section>