(function () {
	document.addEventListener("DOMContentLoaded", () => {
		/** Tabs */
		const tab = document.querySelectorAll(".tab-header");
		tab.forEach((item) => {
			item.addEventListener("click", (e) => {
				document.querySelector(".message--login").innerHTML = "";
				document.querySelector(".message--register").innerHTML = "";
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
			let messageRegister = document.querySelector(".message--register");
			registrationForm.addEventListener("submit", function (e) {
				e.preventDefault();

				/** Get the form data */
				var formData = new FormData(registrationForm);
				formData.append("action", "register_user");
				formData.append("user_login", registrationForm.elements["user_login"].value);
				formData.append("user_email", registrationForm.elements["user_email"].value);
				formData.append("user_pass", registrationForm.elements["user_pass"].value);

				/** Empty values error */
				if (
					registrationForm.elements["user_pass"].value === "" ||
					registrationForm.elements["confirm_password"].value === "" ||
					registrationForm.elements["user_login"].value === "" ||
					registrationForm.elements["user_email"].value === ""
				) {
					messageRegister.classList.remove("message--success");
					messageRegister.classList.add("message--error");
					messageRegister.textContent = "Όλα τα πεδία της φόρμας είναι υποχρεωτικά";
					return;
				}

				/** Password length < 6 error */
				if (registrationForm.elements["user_pass"].value.length < 6) {
					messageRegister.classList.remove("message--success");
					messageRegister.classList.add("message--error");
					messageRegister.textContent = "Ο κωδικός πρέπει να έχει 6 ψηφία και άνω";
					return;
				}

				/** Password not matching password-confirm error */
				if (registrationForm.elements["user_pass"].value !== registrationForm.elements["confirm_password"].value) {
					messageRegister.classList.remove("message--success");
					messageRegister.classList.add("message--error");
					messageRegister.textContent = "Οι κωδικοί δεν ταιριάζουν";
					return;
				}
				/** Submit the form data using Ajax */
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
						if (responseObject.success) {
							messageRegister.classList.remove("message--error");
							messageRegister.classList.add("message--success");
							messageRegister.innerHTML = responseObject.data;
							registrationForm.reset();
						} else {
							messageRegister.classList.remove("message--success");
							messageRegister.classList.add("message--error");
							messageRegister.innerHTML = responseObject.data;
						}
					})
					.catch(function (error) {
						// Handle Ajax errors
						console.error(error);
					});
			});
		}
		/** Login Ajax */
		const loginForm = document.querySelector("form#login");
		if (loginForm) {
			let messageLogin = document.querySelector(".message--login");
			loginForm.addEventListener("submit", function (e) {
				e.preventDefault();
				/** Get the form data */
				const formData = new FormData(loginForm);
				formData.append("action", "login_user");
				formData.append("security", wp_ajax.nonce);
				/** Empty values error */
				if (loginForm.elements["user_pass"].value === "" || loginForm.elements["user_email"].value === "") {
					messageLogin.classList.remove("message--success");
					messageLogin.classList.add("message--error");
					messageLogin.textContent = "Όλα τα πεδία της φόρμας είναι υποχρεωτικά";
					return;
				}

				/** Submit the form data using Ajax */
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
						if (responseObject.success) {
							location.reload(); // Reload the page on successful login
						} else {
							messageLogin.classList.remove("message--success");
							messageLogin.classList.add("message--error");
							messageLogin.innerHTML = responseObject.data;
						}
					})
					.catch(function (error) {
						// Handle Ajax errors
						console.error(error);
					});
			});
		}
	});
})();
