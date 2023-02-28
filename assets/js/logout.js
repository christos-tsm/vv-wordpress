(function () {
	/** Logout Function */
	function logout() {
		// Send a POST request to the WordPress REST API to log out the user
		fetch(wpApiSettings.root + "wp/v2/users/me", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-WP-Nonce": wpApiSettings.nonce,
			},
			body: JSON.stringify({ status: "logged_out" }),
		})
			.then(function (response) {
				if (response.ok) {
					// Redirect the user to the WordPress login page
					window.location.href = wpApiSettings.logout_url;
				} else {
					// Handle the error
					console.log("Logout failed");
				}
			})
			.catch(function (error) {
				// Handle the error
				console.log(error);
			});
	}

	/** Logout */
	const logoutBtn = document.querySelector("#logout");
	logoutBtn &&
		document.querySelector("#logout").addEventListener("click", function () {
			logout();
		});
})();
