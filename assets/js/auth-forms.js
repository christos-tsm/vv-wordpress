(function () {
	document.addEventListener("DOMContentLoaded", function () {
		/** Tabs */
		const tab = document.querySelectorAll(".tab-header");
		tab.forEach((item) => {
			item.addEventListener("click", (e) => {
				document.querySelector(".message").innerHTML = "";
				let target = e.target.getAttribute("data-target");
				document.querySelectorAll(".tab-header").forEach((item) => item.classList.remove("tab-header--active"));
				e.target.classList.add("tab-header--active");
				document.querySelector(".form:not(.form--hidden)").classList.add("form--hidden");
				document.querySelector(`${target}`).classList.remove("form--hidden");
			});
		});
		/** Register Ajax */
		var registrationForm = document.querySelector("form#register");
		if (registrationForm) {
			registrationForm.addEventListener("submit", function (e) {
				e.preventDefault(); // Prevent the default form submission

				// Get the form data
				var formData = new FormData(registrationForm);
				formData.append("action", "register_user");
				formData.append("user_login", registrationForm.elements["user_login"].value);
				formData.append("user_email", registrationForm.elements["user_email"].value);
				formData.append("user_pass", registrationForm.elements["user_pass"].value);
				if (
					registrationForm.elements["user_pass"].value === "" ||
					registrationForm.elements["confirm_password"].value === "" ||
					registrationForm.elements["user_login"].value === "" ||
					registrationForm.elements["user_email"].value === ""
				) {
					document.querySelector(".message--error").textContent = "Όλα τα πεδία της φόρμας είναι υποχρεωτικά";
					return;
				}

				if (registrationForm.elements["user_pass"].value.length < 6) {
					document.querySelector(".message--error").textContent = "Ο κωδικός πρέπει να έχει 6 ψηφία και άνω";
					return;
				}

				if (registrationForm.elements["user_pass"].value !== registrationForm.elements["confirm_password"].value) {
					document.querySelector(".message--error").textContent = "Οι κωδικοί δεν ταιριάζουν";
					return;
				}
				// Submit the form data using Ajax
				fetch(wp_ajax.ajax_url, {
					method: "post",
					body: formData,
				})
					.then(function (response) {
						return response.text();
					})
					.then(function (response) {
						// Handle the Ajax response
						const responseObject = JSON.parse(response);
						console.log(responseObject);
						if (responseObject.success) {
							document.querySelector(".message").classList.remove("message--error");
							document.querySelector(".message").classList.add("message--success");
							document.querySelector(".message").innerHTML = responseObject.data;
							registrationForm.reset();
						} else {
							document.querySelector(".message").classList.remove("message--success");
							document.querySelector(".message").classList.add("message--error");
							document.querySelector(".message").innerHTML = responseObject.data;
						}
					})
					.catch(function (error) {
						// Handle Ajax errors
						console.log(error);
					});
			});
		}
		/** Login Ajax */
		const loginForm = document.querySelector("form#login");
		if (loginForm) {
			loginForm.addEventListener("submit", function (e) {
				e.preventDefault(); // Prevent the default form submission

				// Get the form data
				const formData = new FormData(loginForm);
				formData.append("action", "login_user");

				if (loginForm.elements["user_pass"].value === "" || loginForm.elements["user_email"].value === "") {
					document.querySelector(".message--error").textContent = "Όλα τα πεδία της φόρμας είναι υποχρεωτικά";
					return;
				}

				// Submit the form data using Ajax
				fetch(wp_ajax.ajax_url, {
					method: "post",
					body: formData,
				})
					.then(function (response) {
						console.log(response);
						return response.text();
					})
					.then(function (response) {
						console.log(response);
						// Handle the Ajax response
						const responseObject = JSON.parse(response);
						console.log(responseObject);
						if (responseObject.success) {
							location.reload(); // Reload the page on successful login
						} else {
							document.querySelector(".message").classList.remove("message--success");
							document.querySelector(".message").classList.add("message--error");
							document.querySelector(".message").innerHTML = responseObject.data;
						}
					})
					.catch(function (error) {
						// Handle Ajax errors
						console.log(error);
					});
			});
		}
	});
})();
