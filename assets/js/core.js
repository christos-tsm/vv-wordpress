(function () {
	/** Homepage sliders */
	if (document.querySelector("body").classList.contains("page-template-homepage")) {
		/** Featured Hotels Slider */
		let hotelSlider = new Swiper(".slider--hotels", {
			slidesPerView: 3,
			spaceBetween: 30,

			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});
		/** Featured Events Slider */
		let eventSlider = new Swiper(".slider--events", {
			slidesPerView: 2,
			spaceBetween: 30,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});
		/** Featured Destinations Slider */
		let destinationSlider = new Swiper(".slider--destinations", {
			slidesPerView: 1,
			spaceBetween: 30,
			effect: "fade",
			fadeEffect: {
				crossFade: true,
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});
	}
})();
