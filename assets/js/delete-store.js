(function () {
	document.addEventListener("DOMContentLoaded", () => {
		if (document.querySelector("body").classList.contains("page-template-my-stores-list") && document.getElementById("delete-store-form")) {
			const deleteButtons = document.querySelectorAll(".btn--delete-store");
			deleteButtons.forEach((deleteButton) => {
				deleteButton.addEventListener("click", function (e) {
					e.preventDefault();
					const data = new FormData();
					data.append("action", "delete_store");
					data.append("user_id", document.querySelector('input[name="user_id"]').value);
					data.append("delete_store_nonce", document.querySelector('input[name="delete_store_nonce"]').value);
					data.append("store_id", document.querySelector('input[name="store_id"]').value);
					fetch(wp_ajax.ajax_url, {
						method: "POST",
						body: data,
						credentials: "same-origin",
						headers: {
							"X-Requested-With": "XMLHttpRequest",
						},
					})
						.then((response) => {
							if (response.ok) {
								location.reload();
							} else {
								console.error("An error occurred while deleting store.", error);
							}
						})
						.catch((error) => {
							console.error("An error occurred while deleting store.", error);
						});
				});
			});
		}
	});
})();
