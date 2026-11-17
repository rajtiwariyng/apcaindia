document.addEventListener("DOMContentLoaded", function () {
  let videos = document.querySelectorAll(".hero-banner video");

  videos.forEach((video) => {
    video.addEventListener("canplay", function () {
      this.style.opacity = 1; // Show the video when it's ready
    });
  });
  AOS.init({
    duration: 1000,
    once: true,
  });
  Fancybox.bind("[data-fancybox=gallery]", {
    loop: true,
    buttons: ["zoom", "close"],
  });
  // Sticky Header on Scroll
  const header = document.querySelector("#header");

  function updateHeader() {
    if (header) {
      if (window.scrollY > 50) {
        header.classList.add("fixed-top");
      } else {
        header.classList.remove("fixed-top");
      }
    }
  }
  window.addEventListener("scroll", updateHeader);
  // Search Box Activation
  $(".header-item.item-left .btn").on("click", function () {
    $(".header-item.item-left .search-box").toggleClass("active");
  });

  // Background Letter Fade-in
  setTimeout(() => {
    const bgLetter = document.getElementById("backgroundLetter");
    if (bgLetter) {
      bgLetter.style.display = "block";
      setTimeout(() => {
        bgLetter.style.opacity = "1";
      }, 100);
    }
  }, 1000);

  // Swiper Initializations
  let coursesSwiper = new Swiper(".coursesSwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      768: {
        slidesPerView: 1.5,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: false,
      },
      1024: {
        slidesPerView: 3.5,
      },
    },
  });

  // Swiper Initializations
  let investSwiper = new Swiper(".invest-slider", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    speed: 2000,
    autoHeight: false,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });

  // Swiper Initializations
  let programSlider = new Swiper(".program-testimonials-slider", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: true,
    speed: 2000,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      768: {
        slidesPerView: 1,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: false,
      },
    },
  });

  let homeBlogsSwiper = new Swiper(".homeBlogsSwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 1.5,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      },
    },
  });

  let testimonialSwiper = new Swiper(".testmonial-slider", {
    slidesPerView: 1,
    spaceBetween: 20,
    autoplay: true,
    speed: 1500,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });

  let instructorSwiper = new Swiper(".instructorSwiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: false,
    autoplay: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });

  let partnersSwiper = new Swiper(".partnersSwiper", {
    slidesPerView: 2.3,
    spaceBetween: 15,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    breakpoints: {
      480: {
        slidesPerView: 2.6,
        spaceBetween: 15,
        navigation: false,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      },
      640: {
        slidesPerView: 2.6,
        spaceBetween: 20,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 25,
        pagination: false, // Hide pagination
        navigation: {
          // Show navigation
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: false, // Hide pagination
        navigation: {
          // Show navigation
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      },
    },
  });

  // Blog & Gallery Filter Functionality
  const filterButtons = document.querySelectorAll(".filter-btn");

  function handleFilter(buttons, items) {
    buttons.forEach((button) => {
      button.addEventListener("click", function () {
        const category = this.getAttribute("data-category");

        // Remove active class from all buttons
        buttons.forEach((btn) => btn.classList.remove("active"));
        this.classList.add("active");

        // Filter items
        items.forEach((item) => {
          const itemCategories = item.getAttribute("data-category").split(" ");

          if (category === "all" || itemCategories.includes(category)) {
            item.classList.remove("hidden");
            setTimeout(() => {
              item.style.display = "block";
            }, 300);
          } else {
            item.classList.add("hidden");
            setTimeout(() => {
              item.style.display = "none";
            }, 300);
          }
        });
      });
    });
  }

  const blogItems = document.querySelectorAll(".blog-item");
  handleFilter(filterButtons, blogItems);

  const galleryItems = document.querySelectorAll(".item");
  handleFilter(filterButtons, galleryItems);

  // Sidebar Active Link Handling
  const sidebar = document.getElementById("sidebar");
  const sidebarLinks = sidebar ? sidebar.getElementsByTagName("a") : [];
  const sections = document.querySelectorAll(".coursesWrapperRight section");
  const navbar = document.querySelector(".navbar");

  if (sidebar && navbar) {
    let navbarHeight = navbar.offsetHeight;

    window.addEventListener("resize", function () {
      navbarHeight = navbar.offsetHeight;
      sidebar.style.top = `${navbarHeight}px`;
    });

    function setActiveLink() {
      let current = "";

      sections.forEach((section) => {
        const sectionTop = section.getBoundingClientRect().top;
        if (sectionTop < navbarHeight + 60) {
          current = section.getAttribute("id");
        }
      });

      Array.from(sidebarLinks).forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href").slice(1) === current) {
          link.classList.add("active");
        }
      });
    }

    let ticking = false;
    window.addEventListener(
      "scroll",
      function () {
        if (!ticking) {
          window.requestAnimationFrame(function () {
            setActiveLink();
            ticking = false;
          });
          ticking = true;
        }
      },
      { passive: true }
    );

    Array.from(sidebarLinks).forEach((link) => {
      link.addEventListener("click", function (e) {
        e.preventDefault();
        const targetId = this.getAttribute("href").slice(1);
        const targetSection = document.getElementById(targetId);

        window.scrollTo({
          top: targetSection.offsetTop - navbarHeight - 20,
          behavior: "smooth",
        });
      });
    });

    sidebar.style.top = `${navbarHeight}px`;
  }
  $(".search-box .btn").click(function () {
    $(".search-box input").toggleClass("hello");
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".courseLeftMenu ul li a");
  const sections = Array.from(links).map((link) =>
    document.querySelector(link.getAttribute("href"))
  );

  const observerOptions = {
    root: null,
    rootMargin: "0px 0px -50% 0px", // Trigger when the section is halfway up the viewport
    threshold: 0,
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute("id");
        links.forEach((link) => {
          link.classList.toggle(
            "active",
            link.getAttribute("href") === `#${id}`
          );
        });
      }
    });
  }, observerOptions);

  sections.forEach((section) => {
    if (section) observer.observe(section);
  });
});
