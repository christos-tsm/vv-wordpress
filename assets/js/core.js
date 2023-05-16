(function () {
	document.addEventListener("DOMContentLoaded", () => {
		/** Set local storage items */
		localStorage.setItem("uuid", document.querySelector("body").getAttribute("uuid"));
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
		/** Handle google maps links */
		let addressLinks = document.querySelectorAll(".address-link").length >= 1 ? document.querySelectorAll(".address-link") : document.querySelectorAll(".address-link");
		addressLinks.forEach((link) => {
			const address = link.textContent;
			const trimedAddress = address.replace(/\s+/g, " ").trim();
			const mapsLink = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(trimedAddress)}`;
			link.setAttribute("href", mapsLink);
		});
	});
})();
