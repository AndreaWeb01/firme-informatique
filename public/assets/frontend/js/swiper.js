var swiper = new Swiper('.swiper', {
    speed: 600,
    slidesPerView: 2, // Nombre de slides visibles
    spaceBetween: 30,
    // centeredSlides: false,
    autoplay: {
        delay: 3000, // Temps entre chaque slide (ms)
        disableOnInteraction: false, // Stop l'autoplay si interaction
    },
    loop: true, 
    breakpoints: {
        1000: { 
            slidesPerView: 2,
        },
        769: { // Laptop
            slidesPerView: 1,
        },

        
        650: { // Tablet
            slidesPerView: 2,
        },
        500: { // Mobile
            slidesPerView: 1,
        },

        360:{
            slidesPerView: 1,
        },

        200:{
            slidesPerView: 1,
        }
    },
  });