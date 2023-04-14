(function () {
	document.addEventListener("DOMContentLoaded", () => {
		if (document.querySelector("body").classList.contains("page-template-business-profile")) {
			/** Prevent more than 3 photos for each post */
			// Remove ACF notice
			var notice = document.querySelector(".acf-notice.-error");
			if (notice) {
				notice.remove();
			}
			//Prepopulate uuid field
			document.querySelector('input[name="acf[field_6407ace114b1a]"]').value = localStorage.getItem("uuid");
			// Add event listener to Add Row button
			var repeater = document.querySelector(".acf-field-repeater .acf-table > tbody"),
				addButton = document.querySelector(".acf-field-repeater .acf-actions .acf-button.button-primary");
			addButton.addEventListener("click", function () {
				var numRows = repeater.children.length;
				var fileInputs = repeater.querySelectorAll('input[type="file"]');
				for (var i = 0; i < fileInputs.length; i++) {
					fileInputs[i].accept = "image/png, image/gif, image/jpeg";
				}
				if (numRows >= 4) {
					addButton.disabled = true;
				}
			});
		}
		if (document.querySelector("body").classList.contains("page-template-my-business-profiles-list") && document.getElementById("delete-profile-form")) {
			const deleteButton = document.getElementById("delete-profile-button");
			deleteButton.addEventListener("click", function (e) {
				e.preventDefault();
				const data = new FormData();
				data.append("action", "delete_user_profile");
				data.append("user_id", document.querySelector('input[name="user_id"]').value);
				data.append("delete_profile_nonce", document.querySelector('input[name="delete_profile_nonce"]').value);
				data.append("profile_id", document.querySelector('input[name="profile_id"]').value);
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
							console.error("An error occurred while deleting the profile.", error);
						}
					})
					.catch((error) => {
						console.error("An error occurred while deleting the profile.", error);
					});
			});
		}
	});
})();
