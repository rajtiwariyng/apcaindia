<section class="faq-section">
      <div class="container py-lg-15 py-10 px-md-0 px-10">
        <div class="row align-items-center">
          <!-- FAQ Column -->
          <div class="col-lg-6 m-auto">
            <h2 class="section-title mb-5 text-lg-start text-center blue" data-aos="fade-up">Frequently Asked Questions</h2>
            <div class="accordion" id="faqAccordion">
              <!-- Question 1 (Open by default) -->

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
                           data-bs-parent="#faqAccordion">
                          <div class="accordion-body">
                              {!! $faq->answer !!}
                          </div>
                      </div>
                  </div>
              @endforeach
            </div>

            <div class="mt-4 text-center faq-btn">
              <a href="{{url('/')}}/faq" class="btn btn-primary blue-btn">SEE MORE FAQs</a>
            </div>
          </div>
        </div>
      </div>
    </section>