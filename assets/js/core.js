(function () {
	document.addEventListener("DOMContentLoaded", function () {
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
		/** Handle relationship inputs in business-profile pages */
		setTimeout(() => {
			// Get all relationship fields on the page
			if (document.querySelectorAll(".acf-relationship").length) {
				var relationshipFields = document.querySelectorAll(".acf-relationship");
				// Loop through each relationship field
				relationshipFields.forEach(function (relationshipField) {
					// Create a new select element
					var select = document.createElement("select");
					select.name = relationshipField.querySelector('input[type="hidden"]').name;
					select.classList.add("input", "pointer");
					// Loop through each choice in the relationship field
					relationshipField.querySelectorAll(".choices-list .acf-rel-item").forEach(function (choice) {
						// Create a new option element
						var option = document.createElement("option");
						option.value = choice.dataset.id;
						option.text = choice.innerText;
						// Append the option element to the select element
						select.appendChild(option);
					});
					// Replace the relationship field with the new select element
					relationshipField.parentNode.replaceChild(select, relationshipField);
					// Set the form action to the current URL
					var form = document.querySelector("form");
					form.action = window.location.href;
					console.log(relationshipField);
					document.querySelector('div[data-name="municipality"]').classList.add("input--reveal");
				});
			}
		}, 1000);
		/** Handle google maps links */
		let addressLinks =
			document.querySelectorAll(".profile-card__address a").length >= 1 ? document.querySelectorAll(".profile-card__address a") : document.querySelectorAll(".profile-single__address a");
		addressLinks.forEach((link) => {
			const address = link.textContent;
			const trimedAddress = address.replace(/\s+/g, " ").trim();
			const mapsLink = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(trimedAddress)}`;
			link.setAttribute("href", mapsLink);
		});
	});
})();
