
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  let selectTopbar = select('#topbar')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.add('topbar-scrolled')
        }
      } else {
        selectHeader.classList.remove('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.remove('topbar-scrolled')
        }
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)
*/
  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Preloader
   
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }
  */

  /**
   * Hero carousel indicators */
   
  let heroCarouselIndicators = select("#hero-carousel-indicators")
  let heroCarouselItems = select('#heroCarousel .carousel-item', true)

  heroCarouselItems.forEach((item, index) => {
    (index === 0) ?
    heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "' class='active'></li>":
      heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "'></li>"
  });
  


  /**
   * Clients Slider
   
  new Swiper('.gallery-slider', {
    speed: 400,
    loop: true,
    centeredSlides: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20
      },
      640: {
        slidesPerView: 3,
        spaceBetween: 20
      },
      992: {
        slidesPerView: 5,
        spaceBetween: 20
      }
    }
  });
  */

  /**
   * Initiate gallery lightbox 
  
  const galleryLightbox = GLightbox({
    selector: '.gallery-lightbox'
  });
 */
  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    })
  });

  /**
   * Initiate Pure Counter 
   */
  new PureCounter();

})
()
/*
let contacts = [];

$("#contact-form").validate({
    rules: {
        "contact-name": {
            required: true,
            minlength: 5
        },
        "contact-email": {
            required: true,
            email: true
        },
        "contact-subject": {
            required: true
        },
        "contact-message": {
            required: true,
            minlength: 10
        }
    },
    messages: {
        "contact-name": {
            required: "Please enter your name"
        },
        "contact-email": {
            required: "Please enter an email"
        },
        "contact-subject": {
            required: "Please enter a subject"
        },
        "contact-message": {
            required: "Please enter a message you want to send",
            minlength: "Please enter a valid message"
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault(); // da mi ne submita
        blockUi("body");
        let contact = serializeForm(form);
        console.log(JSON.stringify(contact));

        contacts.push(contact);
        console.log("CONTACTS = ", contacts);
        $("#contact-form")[0].reset();

        unblockUi("body");
    }
});

// $("body").click(() => {
//     $("input:blank").css("border", "1px solid red");
//     $("textarea:blank").css("border", "1px solid red");

//     $("input:filled").css("border", "1px solid rgba(20, 20, 20, 0.1)");
//     $("textarea:filled").css("border", "1px solid rgba(20, 20, 20, 0.1)");
// })

// $("input:blank").focus(() => {
//     $("input:blank").css("border", "1px solid red");
//     $("textarea:blank").css("border", "1px solid red");

//     $("input:filled").css("border", "1px solid rgba(20, 20, 20, 0.1)");
//     $("textarea:filled").css("border", "1px solid rgba(20, 20, 20, 0.1)");
// })

// $("textarea:blank").focus(() => {
//     $("input:blank").css("border", "1px solid red");
//     $("textarea:blank").css("border", "1px solid red");

//     $("input:filled").css("border", "1px solid rgba(20, 20, 20, 0.1)");
//     $("textarea:filled").css("border", "1px solid rgba(20, 20, 20, 0.1)");
// })

// ovo gore iznad skraceno i komplikovanije
$("body").on("click focus", "input, textarea", function() {
    const $inputs = $("input, textarea");
    const $blankInputs = $inputs.filter(function() {
        return !$(this).val().trim();
    });

    $inputs.css("border", "1px solid rgba(20, 20, 20, 0.1)");
    $blankInputs.css("border", "1px solid red");
});

blockUi = (element) => {
    $(element).block({
        message: '<div class="spinner-border text-primary" role="status"></div>',
        css: {
            backgroundColor: "transparent",
            border: "0"
        },
        overlayCSS: {
            backgroundColor: "#000000",
            opacity: 0.25
        }
    });
}

unblockUi = (element) => {
    $(element).unblock({});
}

serializeForm = (form) => {
    let jsonResult = {};
    //console.log($(form).serializeArray());
    //serializeArray() reutrns an array of: name: [name of filed], value: [value of filed] for each field in the form
    $.each($(form).serializeArray(), function() {
        jsonResult[this.name] = this.value;
    });
    return jsonResult;
}*/