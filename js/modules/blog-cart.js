let blogSlider = document.querySelector(".front-blogs-slider");
if (blogSlider) {
  var swiper = new Swiper(".front-blogs-slider", {
    slidesPerView: 5,
    spaceBetween: 20,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    breakpoints: {
      999: {
        slidesPerView: 3,
      },
      680: {
        slidesPerView: 2,
      },
      280: {
        slidesPerView: 1,
      },
    },
  });
}
