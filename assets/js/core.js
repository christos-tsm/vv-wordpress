(function () {
	/** Sliders */
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
	}
})();
