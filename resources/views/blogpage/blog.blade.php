@include("Header::header")
<section class="blog-banner hero-banner" style="background-image: url('./assets/images/blog/layer_3.jpg')">
      <div class="blue-overlay">
        <img src="{{url('/')}}/assets/images/apca-pattern.png" alt="">
      </div>
      <div class="container position-relative banner-content inner-banner-content">
          <div class="row align-items-center min-vh-75">
              <div class="col-lg-6">
                  <div class="content-wrapper" data-aos="fade-right">
                      <h2 class="faculty-title">BLOGS</h2>
                      <p class="faculty-subtitle">Discover and master the art of modern cooking—explore expert tips, recipes, and culinary inspiration on our blog! </p>
                  </div>
              </div>
          </div>
      </div>
      <div class="background-letter" id="backgroundLetter">
        <img src="{{url('/')}}/assets/images/apca-a.png" alt="">
      </div>
    </section>

    
    <section class="blog-section blog-page py-15">

      <div class="container">
        <div class="filter-menu mb-5">
          <button class="filter-btn active" data-category="all">All</button>
          @foreach ($data['categories'] as $category)
              <button class="filter-btn" data-category="{{ Str::slug($category) }}">
                  {{ ucwords($category) }}
              </button>
          @endforeach
          <!-- <button class="filter-btn" data-category="education">
            Education
          </button>
          <button class="filter-btn" data-category="culinary-courses">
            Culinary Courses
          </button>
          <button class="filter-btn" data-category="culinary-school">
             Culinary School
          </button>
          <button class="filter-btn" data-category="baking-courses">
             Baking Courses
          </button>
          <button class="filter-btn" data-category="uncategorized">
             Uncategorized
          </button> -->
        </div>
         
        <div class="row g-4" id="blogGrid">
          @if(isset($term))
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="mb-0">Search Results for "{{ $term }}"</h4>
              <a href="{{url('/')}}/blog" class="filter-btn active">Reset Search</a>
            </div>
          @endif

          <!-- Blog Post 1 -->
          @foreach($data['blogs'] as $blog)
          <div class="col-lg-4 col-md-6 blog-item" data-category="{{ Str::slug($blog->category) }}">
            <div class="blog-card">
              <div class="blog-image">
                <img
                  src="{{url('/')}}/assets/upload/blog/{{$blog->image}}"
                  alt="Blog Image"
                  class="img-fluid"
                />
                <!-- <div class="blog-overlay">
                  <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-heart"></i>
                  </button>
                  <button class="btn btn-light btn-sm">
                    <i class="fa-regular fa-eye"></i>
                  </button>
                </div> -->
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="date">{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</span>
                  <span class="author">BY: Admin</span>
                </div>
                <h3 class="blog-title">
                  {{ucfirst(substr($blog->title, 0, 30))}}
                </h3>
                <div class="blog-excerpt">
                  {!!substr($blog->blog_short_desc, 0, 110)!!}...
                </div>
                <div class="blog-categories">
                  <span class="category-tag">#{{ str_replace(' ', '', ucwords($blog->category)) }}</span>
                </div>
                <a href="{{url('/')}}/blog/{{$blog->slug}}" class="btn btn-primary blue-btn">Read article</a>
              </div>
            </div>
          </div>
           @endforeach

          

          <!-- Add more blog posts here -->
        </div>
      </div>
    </section>
@include('Home::partners')
@include('Footer::footer')