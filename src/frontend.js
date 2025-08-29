document.addEventListener('DOMContentLoaded', function () {
    const sliders = document.querySelectorAll('.wp-block-my-plugin-testimonial-slider');

    sliders.forEach(slider => {
        const slidesPerView = parseInt(slider.dataset.slidesperview, 10) || 1;
        const loop = slider.dataset.loop === 'true';
        const autoplay = slider.dataset.autoplay === 'true';
        const breakpoints = JSON.parse(slider.dataset.breakpoints || '{}');

        const swiperConfig = {
            slidesPerView,
            loop,
            autoplay: autoplay ? { delay: 2500, disableOnInteraction: false } : false,
            spaceBetween: 30,
            breakpoints,
        };

        const paginationEl = slider.querySelector('.swiper-pagination');
        if (paginationEl) {
            swiperConfig.pagination = {
                el: paginationEl,
                clickable: true,
            };
        }

        const prevEl = slider.querySelector('.swiper-button-prev');
        const nextEl = slider.querySelector('.swiper-button-next');
        if (prevEl && nextEl) {
            swiperConfig.navigation = {
                nextEl,
                prevEl,
            };
        }

        new Swiper(slider.querySelector('.swiper'), swiperConfig);
    });
});
