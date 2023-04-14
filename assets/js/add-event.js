(function () {
	document.addEventListener("DOMContentLoaded", () => {
		if (document.getElementById("store_id")) {
			// Init selects
			var options = {
				searchable: false,
				placeholder: document.documentElement.lang === "el" ? "Επιλέξτε την επιχείρησή σας" : "Select your business",
			};
			NiceSelect.bind(document.getElementById("store_id"), options);
			var options = {
				searchable: true,
				placeholder: " ",
				searchtext: "21:00",
			};
			NiceSelect.bind(document.getElementById("time"), options);
			document.getElementById("store_id").addEventListener("change", () => {
				document.querySelector('input[name="store_id"]').value = document.getElementById("store_id").value;
				console.log(document.querySelector('input[name="store_id"]').value);
			});
		}
		if (document.getElementById("cat")) {
			var options = {
				searchable: false,
				placeholder: document.documentElement.lang === "el" ? "Επιλογή κατηγορίας" : "Choose category",
			};
			NiceSelect.bind(document.getElementById("cat"), options);
		}
		if (document.querySelector('input[name="date"]')) {
			flatpickr(document.querySelector('input[name="date"]'), {
				altInput: true,
				altFormat: "F j, Y",
				dateFormat: "Y-m-d",
				minDate: "today",
			});
		}
	});
})();
