(function () {
	document.addEventListener("DOMContentLoaded", () => {
		if (document.getElementById("shop-category")) {
			// Initialize select picker
			var options = {
				searchable: false,
				placeholder: document.documentElement.lang === "el" ? "Επιλογή κατηγορίας" : "Choose category",
			};
			NiceSelect.bind(document.getElementById("shop-category"), options);
			// Choose category to display the correct form for every single custom post type
			const categorySelect = document.querySelector('select[name="shop-category"]');
			categorySelect.addEventListener("change", () => {
				let category = categorySelect.value;
				const urlParams = new URLSearchParams(window.location.search);
				urlParams.set("store", category);
				window.location.search = urlParams;
			});
		}
		if (document.getElementById("cat") && !document.querySelector("body").classList.contains("page-template-add-event")) {
			var options = {
				searchable: false,
				placeholder: document.documentElement.lang === "el" ? "Επιλογή κατηγορίας" : "Choose category",
			};
			NiceSelect.bind(document.getElementById("cat"), options);
		}
		// Create custom photo uploader and display the thumbnails of the uploaded photos
		if (document.querySelector('input[type="file"][name="gallery[]"]')) {
			const inputElement = document.querySelector('input[type="file"][name="gallery[]"]');
			inputElement.addEventListener("change", () => {
				const previewContainer = document.querySelector(".preview-gallery__container");
				previewContainer.innerHTML = ""; // Clear any existing previews
				const fileList = inputElement.files;
				const maxFileSize = 2 * 1024 * 1024; // 2MB
				const maxFiles = 5;
				let fileSizeExceeded = false;
				if (fileList.length > maxFiles) {
					let message = document.documentElement.lang == "el" ? "Μπορείτε να ανεβάσετε εώς και 5 φωτογραφίες" : "Limit of images that can be uploaded is 5";
					alert(message);
					inputElement.value = null; // Reset the input
					previewContainer.innerHTML = ""; // Clear any previews
				}
				for (let i = 0; i < fileList.length; i++) {
					const file = fileList[i];
					if (file.size > maxFileSize) {
						fileSizeExceeded = true;
						break;
					}
					const fileReader = new FileReader();
					fileReader.onload = (event) => {
						const img = document.createElement("img");
						img.classList.add("preview");
						img.src = event.target.result;
						previewContainer.appendChild(img);
					};
					fileReader.readAsDataURL(file);
				}
				if (fileSizeExceeded) {
					let message = document.documentElement.lang == "el" ? "Το μέγεθος της κάθε φωτογραφίας δεν πρέπει να ξεπερνάει τα 2MB" : "One or more files exceed the maximum file size of 2MB";
					alert(message);
					inputElement.value = null; // Reset the input
					previewContainer.innerHTML = ""; // Clear any previews
				}
			});
		}
		// Custom photo uploader with thumbnail for the logo
		if (document.querySelector('input[type="file"][name="logo"]')) {
			const logoElement = document.querySelector('input[type="file"][name="logo"]');
			logoElement.addEventListener("change", function () {
				const logoPreviewContainer = document.querySelector(".preview-logo__container");
				logoPreviewContainer.innerHTML = ""; // Clear any existing previews
				const fileList = logoElement.files;
				const maxFileSize = 2 * 1024 * 1024; // 2MB
				let fileSizeExceeded = false;
				console.log(fileList);
				for (let i = 0; i < fileList.length; i++) {
					const file = fileList[i];
					if (file.size > maxFileSize) {
						fileSizeExceeded = true;
						break;
					}
					const fileReader = new FileReader();
					fileReader.onload = (event) => {
						const img = document.createElement("img");
						img.classList.add("preview");
						img.src = event.target.result;
						logoPreviewContainer.appendChild(img);
					};
					fileReader.readAsDataURL(file);
				}
				if (fileSizeExceeded) {
					let message = document.documentElement.lang == "el" ? "Το μέγεθος της φωτογραφίας δεν πρέπει να ξεπερνάει τα 2MB" : "File exceeded the maximum file size of 2MB";
					alert(message);
					inputElement.value = null; // Reset the input
					logoPreviewContainer.innerHTML = ""; // Clear any previews
				}
			});
		}
		// Append or delete email & tel input rows
		function addRow(type) {
			const container = document.getElementById(`${type}s-container`);
			if (container.childElementCount <= 2) {
				const row = document.createElement("div");
				row.className = `${type}-row`;
				row.innerHTML = `
				<input class="input" type="${type === "email" ? "email" : "tel"}" name="${type}s[]" required>
				<span class="remove-input icon icon--medium icon--delete pointer">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>			  
				</span>
			`;
				container.appendChild(row);
				if (container.childElementCount == 3) {
					if (container.attributes.id.value === "emails-container") {
						document.querySelector("#add-email").classList.add("icon--inactive");
					} else if (container.attributes.id.value === "tels-container") {
						document.querySelector("#add-tel").classList.add("icon--inactive");
					}
				}
			}
		}
		function removeRow(btn) {
			const row = btn.parentNode;
			const container = row.parentNode;
			if (container.children.length > 1) {
				container.removeChild(row);
				if (container.attributes.id.value === "emails-container") {
					document.querySelector("#add-email").classList.remove("icon--inactive");
				} else if (container.attributes.id.value === "tels-container") {
					document.querySelector("#add-tel").classList.remove("icon--inactive");
				}
			}
		}
		// Add click event listener to "add-email" button
		if (document.getElementById("add-email")) {
			const addEmailBtn = document.getElementById("add-email");
			addEmailBtn.addEventListener("click", function () {
				addRow("email");
			});
		}
		// Add click event listener to "add-tel" button
		if (document.getElementById("add-tel")) {
			const addTelBtn = document.getElementById("add-tel");
			addTelBtn.addEventListener("click", function () {
				addRow("tel");
			});
		}
		// Add click event listener to "remove-input" buttons
		const containers = document.querySelectorAll("#emails-container, #tels-container");
		containers.forEach((container) => {
			container.addEventListener("click", function (event) {
				if (event.target.classList.contains("remove-input")) {
					removeRow(event.target);
				}
			});
		});
	});
})();
