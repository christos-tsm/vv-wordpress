(function () {
    document.addEventListener("DOMContentLoaded", () => {
        const changePasswordBtn = document.getElementById('btn-change-password');
        if (changePasswordBtn) {
            const changePasswordForm = document.getElementById('update-user-password-form');
            const oldPasswordInput = document.getElementById('old_password');
            const newPasswordInput = document.getElementById('new_password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const passwordUpdateMessage = document.getElementById('password-change-message');
            const submitContainer = document.querySelector('#update-user-password-form .form-row--submit');
            changePasswordBtn.addEventListener('click', () => {
                changePasswordForm.style.display = 'flex';
            })

            const checkPasswords = () => {
                const passwordLength = 6;
                const submitMessage = document.documentElement.lang === 'el' ? "Αλλαγή κωδικού" : "Update Password";
                if (oldPasswordInput.value.length > 0 && newPasswordInput.value === confirmPasswordInput.value && newPasswordInput.value.length >= passwordLength) {
                    submitContainer.innerHTML = `<button id="update-user-password-form-submit" class="input btn pointer" type="submit">${submitMessage}</button>`;
                } else {
                    submitContainer.innerHTML = "";
                }
            }

            oldPasswordInput.addEventListener("input", checkPasswords);
            newPasswordInput.addEventListener("input", checkPasswords);
            confirmPasswordInput.addEventListener("input", checkPasswords);

            changePasswordForm.addEventListener('submit', (e) => {
                passwordUpdateMessage.classList.remove('message--error');
                passwordUpdateMessage.classList.remove('message--success');
                passwordUpdateMessage.textContent = '';
                e.preventDefault();

                // Check if new password has more than 6 characters
                if (newPasswordInput.value.length < 6 || confirmPasswordInput.value.length < 6) {
                    passwordUpdateMessage.classList.add('message--error');
                    passwordUpdateMessage.textContent = document.documentElement.lang === 'el' ? "Ο κωδικός σας πρέπει να έχει τουλάχιστον 6 χαρακτήρες" : "Your password must contain at least 6 characters";
                    return;
                }

                // Check if new passwords match
                if (newPasswordInput.value !== confirmPasswordInput.value) {
                    passwordUpdateMessage.classList.add('message--error');
                    passwordUpdateMessage.textContent = document.documentElement.lang === 'el' ? "Οι νέοι κωδικοί πρόσβασης δεν ταιριάζουν" : "New passwords do not match";
                    return;
                }

                // Prepare form data
                var formData = new FormData(changePasswordForm);
                formData.append('action', 'update_user_password');
                formData.append('old_password', oldPasswordInput.value);
                formData.append('new_password', newPasswordInput.value);

                // Submit form data
                fetch(wp_ajax.ajax_url, {
                    method: 'post',
                    body: formData,
                })
                    .then(response => response.text())
                    .then(response => {
                        // Handle response
                        const responseObject = JSON.parse(response);
                        console.log(response);
                        console.log(responseObject);
                        if (responseObject.success) {
                            passwordUpdateMessage.classList.remove("message--error");
                            passwordUpdateMessage.classList.add("message--success");
                            passwordUpdateMessage.textContent = responseObject.data.data;
                            oldPasswordInput.value = '';
                            newPasswordInput.value = '';
                            confirmPasswordInput.value = '';
                        } else {
                            console.log('else:')
                            console.log(responseObject);
                            passwordUpdateMessage.classList.remove("message--success");
                            passwordUpdateMessage.classList.add("message--error");
                            passwordUpdateMessage.textContent = responseObject.data;
                        }
                    })
                    .catch(error => {
                        // Handle errors
                        console.error(error);
                    });
            });
        }
    });
})();
