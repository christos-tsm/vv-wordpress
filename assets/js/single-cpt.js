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
		/** Report Form */
		let reportBtn = document.getElementById('report-store');
		let closeReportBtn = document.getElementById('close-report-form');
		reportBtn.addEventListener('click', () => {
			document.querySelector('.report-form__container').classList.add('report-form__container--active');
		});
		closeReportBtn.addEventListener('click', () => {
			document.querySelector('.report-form__container').classList.remove('report-form__container--active');
		});
		/** Handle Report Submissions Number */
		document.addEventListener('wpcf7mailsent', function (event) {
			var message = event.detail.apiResponse.message;
			console.log(message);
			if (message.includes('[already-reported]')) {
				alert('You have already reported this post.');
				// Reload the page or provide other user feedback here
				location.reload();
			}
		}, false);
	});
})();
