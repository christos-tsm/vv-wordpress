(function () {
    document.addEventListener("DOMContentLoaded", () => {
        if (document.querySelector("#report-form")) {
            document.querySelector("#report-form").addEventListener('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                fetch(report_ajax_object.ajax_url, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // Create response div to display based on fetch status
                        let formContainer = document.querySelector('.report-form');
                        let responseDiv = document.createElement('div');
                        responseDiv.classList.add('form-response');
                        let responseMessage = document.createElement('p');
                        responseMessage.classList.add('message');
                        if (data.success) {
                            document.querySelector("#report-form").remove();
                            responseMessage.classList.add('message--success');
                            responseMessage.id = 'reported-sucessfully';
                            responseMessage.textContent = document.documentElement.lang == 'el' ? 'Ευχαριστούμε για την αναφορά σας. Θα εξετάσουμε το αίτημα σας.' : 'Thanks for your report. We will consider your request.';
                        } else {
                            document.querySelector("#report-form").remove();
                            responseMessage.classList.add('message--error');
                            responseMessage.id = 'already-reported';
                            responseMessage.textContent = document.documentElement.lang === 'el' ? 'Έχετε ήδη αναφέρει τη συγκεκριμένη επιχείρηση.' : 'You have already reported this business.';
                        }
                        responseDiv.appendChild(responseMessage);
                        formContainer.appendChild(responseDiv);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            });
        }
    });
})();