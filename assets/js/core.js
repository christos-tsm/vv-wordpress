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
		/** Menu Burger */
		const burgerBtn = document.querySelector('.site-header__burger');
		if (burgerBtn) {
			const navContainer = document.querySelector('.site-header__menu');
			const openMenu = document.getElementById('open-menu');
			const closeMenu = document.getElementById('close-menu');
			burgerBtn.addEventListener('click', (e) => {
				e.stopPropagation();
				if (navContainer.classList.contains('site-header__menu--active')) {
					navContainer.classList.remove('site-header__menu--active');
					openMenu.classList.add('icon--active');
					closeMenu.classList.remove('icon--active');
				} else {
					navContainer.classList.add('site-header__menu--active');
					openMenu.classList.remove('icon--active');
					closeMenu.classList.add('icon--active');
				}
			});
			document.body.addEventListener('click', function (e) {
				if (navContainer.classList.contains('site-header__menu--active')) {
					navContainer.classList.remove('site-header__menu--active');
					openMenu.classList.add('icon--active');
					closeMenu.classList.remove('icon--active');
				}
			});
		}
		/** Header on scroll */
		window.onscroll = () => {
			if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
				document.querySelector('.site-header').classList.add('site-header--scrolled');
			} else {
				document.querySelector('.site-header').classList.remove('site-header--scrolled');
			}
		};
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
