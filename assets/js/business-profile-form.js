(function () {
	/** Prevent more than 3 photos for each post */
	document.addEventListener("DOMContentLoaded", function () {
		// Remove ACF notice
		var notice = document.querySelector(".acf-notice.-error");
		if (notice) {
			notice.remove();
		}

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
	});
})();
