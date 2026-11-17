// Header scroll class

$(window).scroll(function () {
  if ($(this).scrollTop() > 600) {
    $(".affix-top").addClass("affix");
  } else {
    $(".affix-top").removeClass("affix");
  }
});

$(document).ready(function () {
  $(this).scrollTop(0);
});

$(document).ready(function () {
  $("#flip2").click(function () {
    $("#panel2").slideToggle("slow");
  });

  $(".RelationDetailCollapse .panel-title a").click(function () {
    $(this).toggleClass("rotate90");
  });

  $(".payment-offer-box,.popular-bank,.card-type-logo").on(
    "click",
    function () {
      $(this).parent().find(".active").removeClass("active");

      $(this).addClass("active");
    }
  );
});

$(document).ready(function ($) {
  var owl = $(".masterclass1");

  owl.owlCarousel({
    autoplay: false,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    loop: true,
    center: false,
    rewind: false,
    mouseDrag: true,
    touchDrag: true,
    pullDrag: true,
    freeDrag: false,
    margin: 20,
    stagePadding: 0,
    merge: false,
    mergeFit: true,
    autoWidth: false,
    startPosition: 0,
    rtl: false,
    smartSpeed: 2500,
    fluidSpeed: false,
    dragEndSpeed: false,
    nav: false,
    dots: true,
    responsive: {
      0: {
        items: 1,

        // nav: true
      },

      480: {
        items: 1,

        nav: false,
      },

      768: {
        items: 2,

        loop: false,
      },

      992: {
        items: 3,

        loop: true,
      },
    },

    responsiveRefreshRate: 200,

    responsiveBaseElement: window,

    fallbackEasing: "swing",

    info: false,

    nestedItemSelector: false,

    itemElement: "div",

    stageElement: "div",

    refreshClass: "owl-refresh",

    loadedClass: "owl-loaded",

    loadingClass: "owl-loading",

    rtlClass: "owl-rtl",

    responsiveClass: "owl-responsive",

    dragClass: "owl-drag",

    itemClass: "owl-item",

    stageClass: "owl-stage",

    stageOuterClass: "owl-stage-outer",

    grabClass: "owl-grab",

    autoHeight: false,

    lazyLoad: false,
  });

  // $(".next").click(function () {

  //   owl.trigger("owl.next");

  // });

  // $(".prev").click(function () {

  //   owl.trigger("owl.prev");

  // });
});

$(document).ready(function ($) {
  var owl = $(".masterclass");

  owl.owlCarousel({
    autoplay: false,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    loop: true,
    center: false,
    rewind: false,
    mouseDrag: true,
    touchDrag: true,
    pullDrag: true,
    freeDrag: false,
    margin: 20,
    stagePadding: 0,
    merge: false,
    mergeFit: true,
    autoWidth: false,
    startPosition: 0,
    rtl: false,
    smartSpeed: 2500,
    fluidSpeed: false,
    dragEndSpeed: false,
    nav: true,
    dots: true,
    responsive: {
      0: {
        items: 1,

        // nav: true
      },

      480: {
        items: 1,

        nav: false,
      },

      768: {
        items: 1,

        loop: false,
      },

      992: {
        items: 1,

        loop: true,
      },
    },

    responsiveRefreshRate: 200,

    responsiveBaseElement: window,

    fallbackEasing: "swing",

    info: false,

    nestedItemSelector: false,

    itemElement: "div",

    stageElement: "div",

    refreshClass: "owl-refresh",

    loadedClass: "owl-loaded",

    loadingClass: "owl-loading",

    rtlClass: "owl-rtl",

    responsiveClass: "owl-responsive",

    dragClass: "owl-drag",

    itemClass: "owl-item",

    stageClass: "owl-stage",

    stageOuterClass: "owl-stage-outer",

    grabClass: "owl-grab",

    autoHeight: false,

    lazyLoad: false,
  });

  $(".next").click(function () {
    owl.trigger("owl.next");
  });

  $(".prev").click(function () {
    owl.trigger("owl.prev");
  });
});

$(document).ready(function ($) {
  var owl = $(".popularNow");

  owl.owlCarousel({
    autoplay: false,

    autoplayTimeout: 2000,

    autoplayHoverPause: true,

    // items: 4,

    loop: true,

    center: false,

    rewind: false,

    mouseDrag: true,

    touchDrag: true,

    pullDrag: true,

    freeDrag: false,

    margin: 20,

    stagePadding: 0,

    merge: false,

    mergeFit: true,

    autoWidth: false,

    startPosition: 0,

    rtl: false,

    smartSpeed: 250,

    fluidSpeed: false,

    dragEndSpeed: false,

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 1,

        nav: true,
      },

      480: {
        items: 1,

        nav: true,
      },

      768: {
        items: 2,

        loop: true,
      },

      992: {
        items: 3,

        loop: true,
      },
    },

    responsiveRefreshRate: 200,

    responsiveBaseElement: window,

    fallbackEasing: "swing",

    info: false,

    nestedItemSelector: false,

    itemElement: "div",

    stageElement: "div",

    refreshClass: "owl-refresh",

    loadedClass: "owl-loaded",

    loadingClass: "owl-loading",

    rtlClass: "owl-rtl",

    responsiveClass: "owl-responsive",

    dragClass: "owl-drag",

    itemClass: "owl-item",

    stageClass: "owl-stage",

    stageOuterClass: "owl-stage-outer",

    grabClass: "owl-grab",

    autoHeight: false,

    lazyLoad: false,
  });

  $(".next").click(function () {
    owl.trigger("owl.next");
  });

  $(".prev").click(function () {
    owl.trigger("owl.prev");
  });
});

$(document).ready(function ($) {
  var owl = $(".Trending");

  owl.owlCarousel({
    autoplay: true,

    autoplayTimeout: 5000,

    autoplayHoverPause: true,

    items: 3,

    loop: true,

    center: false,

    rewind: false,

    mouseDrag: true,

    touchDrag: true,

    pullDrag: true,

    freeDrag: false,

    margin: 20,

    stagePadding: 0,

    merge: false,

    mergeFit: true,

    autoWidth: false,

    startPosition: 0,

    rtl: false,

    smartSpeed: 250,

    fluidSpeed: false,

    dragEndSpeed: false,

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 1,

        // nav: true
      },

      480: {
        items: 1,

        nav: false,
      },

      768: {
        items: 2,

        loop: true,
      },

      992: {
        items: 3,

        loop: true,
      },
    },

    responsiveRefreshRate: 200,

    responsiveBaseElement: window,

    fallbackEasing: "swing",

    info: false,

    nestedItemSelector: false,

    itemElement: "div",

    stageElement: "div",

    refreshClass: "owl-refresh",

    loadedClass: "owl-loaded",

    loadingClass: "owl-loading",

    rtlClass: "owl-rtl",

    responsiveClass: "owl-responsive",

    dragClass: "owl-drag",

    itemClass: "owl-item",

    stageClass: "owl-stage",

    stageOuterClass: "owl-stage-outer",

    grabClass: "owl-grab",

    autoHeight: false,

    lazyLoad: false,
  });

  $(".next").click(function () {
    owl.trigger("owl.next");
  });

  $(".prev").click(function () {
    owl.trigger("owl.prev");
  });
});

// $(document).ready(function ($) {

//   var owl = $(".Categories");

//   owl.owlCarousel({

//     autoplay: true,

//     autoplayTimeout: 700,

//     autoplayHoverPause: true,

//     items: 3,

//     loop: true,

//     center: false,

//     rewind: false,

//     mouseDrag: true,

//     touchDrag: true,

//     pullDrag: true,

//     freeDrag: false,

//     margin: 20,

//     stagePadding: 0,

//     merge: false,

//     mergeFit: true,

//     autoWidth: false,

//     startPosition: 0,

//     rtl: false,

//     smartSpeed: 250,

//     fluidSpeed: false,

//     dragEndSpeed: false,

//     nav: true,

//     dots: false,

//     responsive: {

//       0: {

//         items: 1

//         // nav: true

//       },

//       480: {

//         items: 1,

//         nav: false

//       },

//       768: {

//         items: 2,

//         loop: false

//       },

//       992: {

//         items: 4,

//         loop: false

//       }

//     },

//     responsiveRefreshRate: 200,

//     responsiveBaseElement: window,

//     fallbackEasing: "swing",

//     info: false,

//     nestedItemSelector: false,

//     itemElement: "div",

//     stageElement: "div",

//     refreshClass: "owl-refresh",

//     loadedClass: "owl-loaded",

//     loadingClass: "owl-loading",

//     rtlClass: "owl-rtl",

//     responsiveClass: "owl-responsive",

//     dragClass: "owl-drag",

//     itemClass: "owl-item",

//     stageClass: "owl-stage",

//     stageOuterClass: "owl-stage-outer",

//     grabClass: "owl-grab",

//     autoHeight: false,

//     lazyLoad: false

//   });

//   $(".next").click(function () {

//     owl.trigger("owl.next");

//   });

//   $(".prev").click(function () {

//     owl.trigger("owl.prev");

//   });

// });

$(document).ready(function ($) {
  var owl = $(".Experience");

  owl.owlCarousel({
    autoplay: true,

    loop: true,

    center: false,

    rewind: false,

    mouseDrag: true,

    touchDrag: true,

    pullDrag: true,

    freeDrag: false,

    stagePadding: 0,

    merge: false,

    mergeFit: true,

    autoWidth: false,

    smartSpeed: 250,

    fluidSpeed: false,

    dragEndSpeed: false,

    margin: 30,

    nav: true,

    dots: true,

    responsive: {
      0: {
        items: 1,

        // nav: true
      },

      480: {
        items: 1,

        nav: false,
      },

      768: {
        items: 1,

        // nav: true,

        loop: true,
      },

      992: {
        items: 1,

        // nav: true,

        loop: true,
      },
    },
  });
});

$(document).ready(function ($) {
  var owl = $(".Members");

  owl.owlCarousel({
    autoplay: true,

    loop: true,

    center: false,

    rewind: false,

    mouseDrag: true,

    touchDrag: true,

    pullDrag: true,

    freeDrag: false,

    stagePadding: 0,

    merge: false,

    mergeFit: true,

    autoWidth: false,

    smartSpeed: 250,

    fluidSpeed: false,

    dragEndSpeed: false,

    margin: 30,

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 1,

        // nav: true
      },

      480: {
        items: 2,

        nav: false,
      },

      768: {
        items: 3,

        // nav: true,

        loop: true,
      },

      992: {
        items: 6,

        // nav: true,

        loop: true,
      },
    },
  });
});

$(document).ready(function ($) {
  var owl = $(".Categories");

  owl.owlCarousel({
    autoplay: true,

    autoplayTimeout: 2000,

    autoplayHoverPause: true,

    loop: true,

    center: false,

    rewind: false,

    mouseDrag: true,

    touchDrag: true,

    pullDrag: true,

    freeDrag: false,

    stagePadding: 0,

    merge: false,

    mergeFit: true,

    autoWidth: false,

    smartSpeed: 250,

    fluidSpeed: false,

    dragEndSpeed: false,

    margin: 30,

    nav: true,

    dots: false,

    responsive: {
      0: {
        items: 1,

        // nav: true
      },

      480: {
        items: 1,

        nav: false,
      },

      768: {
        items: 2,

        // nav: true,

        loop: true,
      },

      992: {
        items: 4,

        // nav: true,

        loop: true,
      },
    },
  });

  $(document).ready(function ($) {
    var owl = $(".iconCrausal");

    owl.owlCarousel({
      // autoplay: true,

      autoplayTimeout: 3000,

      autoplayHoverPause: true,

      // items: 5,

      loop: true,

      center: false,

      rewind: false,

      mouseDrag: true,

      touchDrag: true,

      pullDrag: true,

      freeDrag: false,

      stagePadding: 0,

      merge: false,

      mergeFit: true,

      autoWidth: false,

      smartSpeed: 250,

      fluidSpeed: false,

      dragEndSpeed: false,

      margin: 30,

      nav: true,

      dots: false,

      responsive: {
        0: {
          items: 2,

          autoplay: true,

          // nav: true
        },

        480: {
          items: 2,

          nav: false,
        },

        768: {
          items: 3,

          // nav: true,

          loop: true,
        },

        992: {
          items: 5,

          // nav: true,

          autoplay: false,

          loop: true,
        },
      },
    });

    $(".next").click(function () {
      owl.trigger("owl.next");
    });

    $(".prev").click(function () {
      owl.trigger("owl.prev");
    });
  });

  $(document).ready(function ($) {
    var owl = $(".masterChefs");

    owl.owlCarousel({
      autoplay: false,

      autoplayTimeout: 3000,

      autoplayHoverPause: true,

      // items: 4,

      loop: true,

      center: false,

      rewind: false,

      mouseDrag: true,

      touchDrag: true,

      pullDrag: true,

      freeDrag: false,

      stagePadding: 0,

      merge: false,

      mergeFit: true,

      autoWidth: false,

      smartSpeed: 250,

      fluidSpeed: false,

      dragEndSpeed: false,

      margin: 30,

      nav: true,

      dots: false,

      responsive: {
        0: {
          items: 1,

          // nav: true
        },

        480: {
          items: 1,

          nav: false,
        },

        768: {
          items: 2,

          // nav: true,

          loop: true,
        },

        992: {
          items: 4,

          // nav: true,

          loop: true,
        },
      },
    });

    $(".next").click(function () {
      owl.trigger("owl.next");
    });

    $(".prev").click(function () {
      owl.trigger("owl.prev");
    });
  });

  $(document).ready(function ($) {
    var owl = $(".testimonial");

    owl.owlCarousel({
      autoplay: false,

      autoplayTimeout: 3000,

      autoplayHoverPause: true,

      loop: true,

      touchDrag: true,

      pullDrag: true,

      smartSpeed: 250,

      margin: 30,

      nav: true,

      dots: false,

      responsive: {
        0: {
          items: 1,

          nav: true,
        },

        480: {
          items: 1,

          nav: true,
        },

        768: {
          items: 1,

          nav: true,
        },

        992: {
          items: 2,

          nav: true,

          loop: true,
        },
      },
    });

    $(".next").click(function () {
      owl.trigger("owl.next");
    });

    $(".prev").click(function () {
      owl.trigger("owl.prev");
    });
  });

  $(".next").click(function () {
    owl.trigger("owl.next");
  });

  $(".prev").click(function () {
    owl.trigger("owl.prev");
  });
});
