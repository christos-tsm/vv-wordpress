(function () {
	document.addEventListener("DOMContentLoaded", () => {
		if (document.querySelector("body").classList.contains("page-template-my-stores-list") || document.querySelector("body").classList.contains("page-template-my-events-list") && document.getElementById("delete-store-form")) {
			const deleteButtons = document.querySelectorAll(".btn--delete-store");
			deleteButtons.forEach((deleteButton) => {
				deleteButton.addEventListener("click", function (e) {
					e.preventDefault();
					const form = deleteButton.closest('form'); // Find the nearest parent form element
					let data = new FormData(form); // Use the found form to create FormData
					// Append any additional data specific to this button or action
					data.append("action", "delete_store");
					data.append("user_id", form.querySelector('input[name="user_id"]').value);
					data.append("delete_store_nonce", form.querySelector('input[name="delete_store_nonce"]').value);
					data.append("store_id", form.querySelector('input[name="store_id"]').value);
					console.log(data);
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
