(function () {
	document.addEventListener("DOMContentLoaded", () => {
		/** Leaflet Map */
		if (document.getElementById("map")) {
			let coordinates = document.getElementById("map").getAttribute("data-coordinates");
			let coordinatesArray = coordinates.split(",").map(parseFloat);
			let iconUrl = document.getElementById("map").getAttribute("data-icon");
			var mapPin = L.icon({
				iconUrl: iconUrl,
				iconSize: [38, 38],
				iconAnchor: [19, 38],
				popupAnchor: [0, -38],
			});
			var map = L.map("map").setView(coordinatesArray, 16);
			var marker = L.marker(coordinatesArray, { icon: mapPin }).addTo(map);
			L.tileLayer("https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png", {
				maxZoom: 19,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
			}).addTo(map);
		}
	});
})();
