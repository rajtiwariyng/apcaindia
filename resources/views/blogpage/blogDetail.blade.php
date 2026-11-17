@include("Header::header")
<section class="blog-banner hero-banner" style="background-image: url('/assets/upload/blog/{{$blog->image}}')">
      <!-- <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative">
          <div class="row align-items-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title">BLOGS</h2>
                      <p class="faculty-subtitle">Lorem ipsum dolor sit amet consectetur, adipisicing elit. In non pariatur libero suscipit sit laborum obcaecati nostrum sapiente est quae. </p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div> -->
    </section>

    <section class="blog-detail-page py-15">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h2 class="blog-detail-title">{{ucfirst($blog->title)}} </h2>
            <div class="d-flex gap-5 align-items-center">
              <div class="author-box">
                <ul>
                  <li>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</li>
                  <li>By : Admin</li>
                </ul>
              </div>
              <div class="blog-categories ps-md-5">
                <span class="category-tag">#{{ str_replace(' ', '', ucwords($blog->category)) }}</span>
                <!-- <span class="category-tag">#Uncategorized</span> -->
              </div>
            </div>
            <div class="blog-detail-description mt-10">
              {!! $blog->description !!}
            </div>
            
          </div>
          <div class="col-md-4">
            <div class="viewsNlikes py-10">
              <!-- <div class="blogView">
                View: 15 <span><i class="fa-regular fa-eye"></i></span>
              </div> -->
              <!-- <div class="blogView">
                Like: 5 <span><i class="fa-regular fa-heart"></i></span>
              </div> -->
            </div>
            <div class="recent-blogs blog-page">
              <h5>Recent Blogs</h5>

              @foreach ($data['LatestBlogs'] as $blog)
                <div class="blog-card">
                  <div class="blog-image">
                    <img src="{{ url('/') }}/assets/upload/blog/{{ $blog->image }}" alt="Blog Image" class="img-fluid">
                    <div class="blog-overlay">
                      <button class="btn btn-light btn-sm">
                        <i class="fa-regular fa-heart"></i>
                      </button>
                      <button class="btn btn-light btn-sm">
                        <i class="fa-regular fa-eye"></i>
                      </button>
                    </div>
                  </div>

                  <div class="blog-content">
                    <div class="blog-meta">
                      <span class="date">{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</span>
                      <span class="author">BY: Admin</span>
                    </div>

                    <h3 class="blog-title">
                      {{ Str::limit(strtoupper($blog->title), 60) }}
                    </h3>

                    <p class="blog-excerpt">
                      {{ Str::limit(strip_tags($blog->blog_short_desc), 160) }}
                    </p>

                    <div class="blog-categories">
                      <span class="category-tag">#{{ str_replace(' ', '', ucwords($blog->category)) }}</span>
                    </div>

                    <a href="{{ url('/') }}/blog/{{ $blog->slug }}" class="btn btn-primary blue-btn">Read article</a>
                  </div>
                </div>
              @endforeach
            </div>

            <!-- <div class="recent-blogs blog-page">
              <h5>Recent Blogs</h5>
              <div class="blog-card">
                <div class="blog-image">
                  <img src="{{url('/')}}/assets/images/blog/layer_3_2.jpg" alt="Blog Image" class="img-fluid">
                  <div class="blog-overlay">
                    <button class="btn btn-light btn-sm">
                      <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="btn btn-light btn-sm">
                      <i class="fa-regular fa-eye"></i>
                    </button>
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
                    <span class="category-tag">#{{ str_replace(' ', '', ucwords($blog->category)) }}</span>
                  </div>
                  <a href="#" class="btn btn-primary blue-btn">Read article</a>
                </div>
              </div>

              <div class="blog-card">
                <div class="blog-image">
                  <img src="{{url('/')}}/assets/images/blog/layer_3_2.jpg" alt="Blog Image" class="img-fluid">
                  <div class="blog-overlay">
                    <button class="btn btn-light btn-sm">
                      <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="btn btn-light btn-sm">
                      <i class="fa-regular fa-eye"></i>
                    </button>
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
            </div> -->
          </div>
        </div>
      </div>
    </section>

@include('Home::partners')
@include('Footer::footer')