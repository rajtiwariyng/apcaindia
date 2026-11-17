@include("Header::header")
<section class="banner">
      <img src="assets/images/blog/layer_3.jpg" alt="" class="img-fluid" />
    </section>
    <section class="blog-section blog-page py-15">
      <div class="container">
        <div class="filter-menu mb-5">
          <button class="filter-btn active" data-category="all">ALL</button>
          <button class="filter-btn" data-category="education">
            EDUCATION
          </button>
          <button class="filter-btn" data-category="culinary-courses">
            Events
          </button>
          <button class="filter-btn" data-category="culinary-school">
           Distinguished Series
          </button>
          <button class="filter-btn" data-category="baking-courses">
            Student Stories
          </button>
          <!-- <button class="filter-btn" data-category="uncategorized">
            UNCATEGORIZED
          </button> -->
        </div>

        <div class="row g-4" id="blogGrid">
          <!-- Blog Post 1 -->
          <div
            class="col-lg-4 col-md-6 blog-item"
            data-category="education culinary-courses"
          >
            <div class="blog-card">
              <div class="blog-image">
                <img
                  src="{{url('/')}}/assets/images/blog/layer_3_2.jpg"
                  alt="Blog Image"
                  class="img-fluid"
                />
                <div class="blog-overlay">
                  <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                  <!-- <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-eye"></i>
                  </button> -->
                </div>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="date">24 august, 2024</span>
                  <span class="author">BY: Admin</span>
                </div>
                <h3 class="blog-title">
                  LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISICING ELIT,
                </h3>
                <p class="blog-excerpt">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="blog-categories">
                  <span class="category-tag">#Education</span>
                </div>
                <a href="#" class="btn btn-primary blue-btn">Read article</a>
              </div>
            </div>
          </div>

          <!-- Blog Post 2 -->
          <div
            class="col-lg-4 col-md-6 blog-item"
            data-category="culinary-courses culinary-school"
          >
            <div class="blog-card">
              <div class="blog-image">
                <img
                  src="{{url('/')}}/assets/images/blog/rectangle_2_2.png"
                  alt="Blog Image"
                  class="img-fluid"
                />
                <div class="blog-overlay">
                  <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                  <!-- <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-eye"></i>
                  </button> -->
                </div>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="date">17 august, 2024</span>
                  <span class="author">BY: Admin</span>
                </div>
                <h3 class="blog-title">
                  LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISICING ELIT,
                </h3>
                <p class="blog-excerpt">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="blog-categories">
                  <span class="category-tag">#Culinary courses</span>
                  <span class="category-tag">#Culinary School</span>
                </div>
                <a href="#" class="btn btn-primary blue-btn">Read article</a>
              </div>
            </div>
          </div>

          <!-- Blog Post 3 -->
          <div
            class="col-lg-4 col-md-6 blog-item"
            data-category="baking-courses uncategorized"
          >
            <div class="blog-card">
              <div class="blog-image">
                <img
                  src="{{url('/')}}/assets/images/blog/rectangle_2_3.png"
                  alt="Blog Image"
                  class="img-fluid"
                />
                <div class="blog-overlay">
                  <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                  <!-- <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-eye"></i>
                  </button> -->
                </div>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="date">17 august, 2024</span>
                  <span class="author">BY: Admin</span>
                </div>
                <h3 class="blog-title">
                  LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISICING ELIT,
                </h3>
                <p class="blog-excerpt">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="blog-categories">
                  <span class="category-tag">#Baking courses</span>
                  <span class="category-tag">#Uncategorized</span>
                </div>
                <a href="#" class="btn btn-primary blue-btn">Read article</a>
              </div>
            </div>
          </div>
          <!-- Blog Post 4 -->
          <div
            class="col-lg-4 col-md-6 blog-item"
            data-category="baking-courses uncategorized"
          >
            <div class="blog-card">
              <div class="blog-image">
                <img
                  src="{{url('/')}}/assets/images/blog/rectangle_2_4.png"
                  alt="Blog Image"
                  class="img-fluid"
                />
                <div class="blog-overlay">
                  <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                  <!-- <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-eye"></i>
                  </button> -->
                </div>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="date">17 august, 2024</span>
                  <span class="author">BY: Admin</span>
                </div>
                <h3 class="blog-title">
                  LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISICING ELIT,
                </h3>
                <p class="blog-excerpt">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="blog-categories">
                  <span class="category-tag">#Baking courses</span>
                  <span class="category-tag">#Uncategorized</span>
                </div>
                <a href="#" class="btn btn-primary blue-btn">Read article</a>
              </div>
            </div>
          </div>

          <!-- Blog Post 5 -->
          <div
            class="col-lg-4 col-md-6 blog-item"
            data-category="baking-courses uncategorized culinary-school"
          >
            <div class="blog-card">
              <div class="blog-image">
                <img
                  src="{{url('/')}}/assets/images/blog/rectangle_2_5.png"
                  alt="Blog Image"
                  class="img-fluid"
                />
                <div class="blog-overlay">
                  <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                  <!-- <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-eye"></i>
                  </button> -->
                </div>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="date">17 august, 2024</span>
                  <span class="author">BY: Admin</span>
                </div>
                <h3 class="blog-title">
                  LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISICING ELIT,
                </h3>
                <p class="blog-excerpt">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="blog-categories">
                  <span class="category-tag">#Baking courses</span>
                  <span class="category-tag">#Uncategorized</span>
                </div>
                <a href="#" class="btn btn-primary blue-btn">Read article</a>
              </div>
            </div>
          </div>

          <!-- Blog Post 6 -->
          <div
            class="col-lg-4 col-md-6 blog-item"
            data-category="baking-courses uncategorized"
          >
            <div class="blog-card">
              <div class="blog-image">
                <img
                  src="{{url('/')}}/assets/images/blog/rectangle_2_6.png"
                  alt="Blog Image"
                  class="img-fluid"
                />
                <div class="blog-overlay">
                  <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                  <!-- <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-eye"></i>
                  </button> -->
                </div>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="date">17 august, 2024</span>
                  <span class="author">BY: Admin</span>
                </div>
                <h3 class="blog-title">
                  LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISICING ELIT,
                </h3>
                <p class="blog-excerpt">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="blog-categories">
                  <span class="category-tag">#Baking courses</span>
                  <span class="category-tag">#Uncategorized</span>
                </div>
                <a href="#" class="btn btn-primary blue-btn">Read article</a>
              </div>
            </div>
          </div>

          <!-- Add more blog posts here -->
        </div>
      </div>
    </section>
    <section class="partners-section">
      <div class="container border-top1px py-15">
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