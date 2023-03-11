(function () {
	document.addEventListener("DOMContentLoaded", function () {
		/** Leaflet Map */
		if (document.querySelector("#map")) {
			var map = L.map("map").setView([51.505, -0.09], 13);
			L.tileLayer("https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png", {
				maxZoom: 19,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
			}).addTo(map);
		}
	});
})();
