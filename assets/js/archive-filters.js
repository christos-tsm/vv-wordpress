(function () {
	document.addEventListener("DOMContentLoaded", () => {
		let categoryItems = document.querySelectorAll(".archive__categories-list-item");
		const archiveContent = document.querySelector(".archive__content");
		categoryItems.forEach(function (item) {
			item.addEventListener("click", async (e) => {
				categoryItems.forEach((item) => item.classList.remove("archive__categories-list-item--active"));
				e.preventDefault();
				item.classList.add("archive__categories-list-item--active");
				const categoryID = item.dataset.id;
				const postType = item.dataset.type;
				const taxonomy = item.dataset.taxonomy;
				const response = await fetch(`${wp_ajax.ajax_url}?action=filter_cpt&category=${categoryID}&post_type=${postType}&taxonomy=${taxonomy}`);
				const filteredResults = await response.text();
				archiveContent.innerHTML = filteredResults;
			});
		});
	});
})();
