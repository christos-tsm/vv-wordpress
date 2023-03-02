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
		let eventSlider = new Swiper(".slider--events", {
			slidesPerView: 2,
			spaceBetween: 30,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});
	}
})();
