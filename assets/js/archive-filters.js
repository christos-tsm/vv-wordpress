(function () {
	document.addEventListener("DOMContentLoaded", () => {
		let categoryItems = document.querySelectorAll(".archive__categories-list-item");
		const archiveContent = document.querySelector(".archive__content");

		const setLoadingClass = (isLoading) => {
			if (isLoading) {
				archiveContent.classList.add("loading");
			} else {
				archiveContent.classList.remove("loading");
			}
		};

		const setLoadingSpinner = (isLoading) => {
			const loadingSpinnerContainer = archiveContent.querySelector(".loading-spinner__container");
			if (isLoading) {
				if (!loadingSpinnerContainer) {
					const spinnerHtml = `
                        <div class="loading-spinner__container">
                            <span class="loader"></span>
                        </div>`;
					archiveContent.insertAdjacentHTML("afterbegin", spinnerHtml);
				}
			} else {
				if (loadingSpinnerContainer) {
					loadingSpinnerContainer.remove();
				}
			}
		};

		const setLoading = (isLoading) => {
			setLoadingClass(isLoading);
			setLoadingSpinner(isLoading);
		};

		categoryItems.forEach(function (item) {
			item.addEventListener("click", async (e) => {
				categoryItems.forEach((item) => item.classList.remove("archive__categories-list-item--active"));
				e.preventDefault();
				item.classList.add("archive__categories-list-item--active");
				const categoryID = item.dataset.id;
				const postType = item.dataset.type;
				const taxonomy = item.dataset.taxonomy;
				setLoading(true);
				const response = await fetch(`${wp_ajax.ajax_url}?action=filter_cpt&category=${categoryID}&post_type=${postType}&taxonomy=${taxonomy}`);
				const filteredResults = await response.text();
				setLoading(false);
				archiveContent.innerHTML = filteredResults;
			});
		});
	});
})();
