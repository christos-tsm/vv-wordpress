(function () {
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelector('#add-store-to-favourites').addEventListener('click', function () {
            const postID = this.dataset.postId;
            // Determine if this is a favorite or not
            const action = this.dataset.action;
            // Send the AJAX request
            fetch(report_ajax_object.ajax_url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'action=' + action + '&post_id=' + postID + '&nonce=' + report_ajax_object.nonce
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(data => {
                if (data.success) {
                    // Toggle the 'favorited' class
                    this.classList.toggle('favourited');
                } else {
                    // Handle error
                    console.error('Error favoriting post:', data);
                }
            }).catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        });
    });
})();
