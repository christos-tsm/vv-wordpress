(function () {
	document.addEventListener("DOMContentLoaded", () => {
		/** Only characters REGEX */
		const onlyCharactersREGEX = /^[\p{L}\s'-]+$/u;
		const emailREGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		/** Get form elements */
		const submitContainer = document.querySelector(".form-row--submit");
		const firstName = document.querySelector("#first_name");
		const firstNameError = document.querySelector("#first_name_error");
		const lastName = document.querySelector("#last_name");
		const lastNameError = document.querySelector("#last_name_error");
		const userEmail = document.querySelector("#user_email");
		const emailError = document.querySelector("#email_error");
		const lang = document.documentElement.lang;
		const submitMessage = lang === "el" ? "Ενημέρωση" : "Update";
		/** Validate inputs function */
		const validateInput = (input, regex, error, errorMessage) => {
			if (regex.test(input.value)) {
				input.classList.remove("invalid");
				error.textContent = "";
			} else {
				error.textContent = errorMessage;
				input.classList.add("invalid");
			}
		};
		firstName.addEventListener("input", () => {
			let message;
			lang === "el" ? (message = "Το όνομα πρέπει να περιέχει μόνο χαρακτήρες.") : (message = "First name must contain only characters.");
			validateInput(firstName, onlyCharactersREGEX, firstNameError, message);
			if (firstName.value.match(onlyCharactersREGEX) && firstName.value.length >= 3 && lastName.value.match(onlyCharactersREGEX) && lastName.value.length >= 3 && userEmail.validity.valid) {
				submitContainer.innerHTML = `<button id="update-user-details-form-submit" class="input btn pointer" type="submit">${submitMessage}</button>`;
			} else {
				submitContainer.innerHTML = "";
			}
		});
		lastName.addEventListener("input", () => {
			let message;
			lang === "el" ? (message = "Το επίθετο πρέπει να περιέχει μόνο χαρακτήρες.") : (message = "Last name must contain only characters.");
			validateInput(lastName, onlyCharactersREGEX, lastNameError, message);
			if (firstName.value.match(onlyCharactersREGEX) && firstName.value.length >= 3 && lastName.value.match(onlyCharactersREGEX) && lastName.value.length >= 3 && userEmail.validity.valid) {
				submitContainer.innerHTML = `<button id="update-user-details-form-submit" class="input btn pointer" type="submit">${submitMessage}</button>`;
			} else {
				submitContainer.innerHTML = "";
			}
		});
		/** Check if email is a valid email */
		userEmail.addEventListener("input", () => {
			let message;
			lang === "el" ? (message = "Το email δεν είναι έγκυρο.") : (message = "Invalid email.");
			validateInput(userEmail, emailREGEX, emailError, message);
			if (firstName.value.match(onlyCharactersREGEX) && firstName.value.length >= 3 && lastName.value.match(onlyCharactersREGEX) && lastName.value.length >= 3 && userEmail.validity.valid) {
				submitContainer.innerHTML = `<button id="update-user-details-form-submit" class="input btn pointer" type="submit">${submitMessage}</button>`;
			} else {
				submitContainer.innerHTML = "";
			}
		});
		/** Handle form submit */
		var updateForm = document.querySelector("#update-user-details-form");
		if (updateForm) {
			let messageUpdate = document.querySelector(".message--update");
			updateForm.addEventListener("submit", (e) => {
				e.preventDefault();
				/** Get the form data */
				var formData = new FormData(updateForm);
				formData.append("action", "update_user_details");
				formData.append("first_name", updateForm.elements["first_name"].value);
				formData.append("last_name", updateForm.elements["last_name"].value);
				formData.append("user_email", updateForm.elements["user_email"].value);
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
							messageUpdate.classList.remove("message--error");
							messageUpdate.classList.add("message--success");
							messageUpdate.innerHTML = responseObject.data.data;
						} else {
							messageUpdate.classList.remove("message--success");
							messageUpdate.classList.add("message--error");
							messageUpdate.innerHTML = responseObject.data.data;
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
