(function () {
	document.addEventListener("DOMContentLoaded", () => {
		/** Gallery Slider */
		let hotelSlider = new Swiper(".single-gallery", {
			slidesPerView: 3,
			spaceBetween: 30,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});
		console.log("sss");
	});
})();
