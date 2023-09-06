(function () {
	document.addEventListener("DOMContentLoaded", () => {
		if (document.getElementById('freelancers-search')) {
			var options = {
				searchable: true,
				placeholder: document.documentElement.lang === "el" ? "Αναζήτηση επαγγελματία" : "Search for local professionals",
				searchtext: document.documentElement.lang === "el" ? "Ηλεκτρολόγος" : "Electrician",
			};
			NiceSelect.bind(document.getElementById("profile_category"), options);
			var municipalityOptions = {
				searchable: true,
				placeholder: document.documentElement.lang === "el" ? "Βόλος" : "Volos",
				searchtext: document.documentElement.lang === "el" ? "Βόλος" : "Volos",
			};
			NiceSelect.bind(document.getElementById("municipality_header"), municipalityOptions);
		}
	});
})();
