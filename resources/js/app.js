import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

let latitude = -0.9029821741503987, // Default latitude
    longitude = 119.85871178991329; // Default longitude
let map, marker; // Declare map and marker globally

// Initialize the map with default coordinates
function initMap() {
    map = L.map("map").setView([latitude, longitude], 13); // Set zoom level

    // Add Google streets layer to the map
    let googleStreets = L.tileLayer(
        "http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}",
        {
            maxZoom: 20,
            subdomains: ["mt0", "mt1", "mt2", "mt3"],
        }
    );
    googleStreets.addTo(map);

    // Add draggable marker for the default location
    marker = L.marker([latitude, longitude], { draggable: true })
        .addTo(map)
        .bindPopup(`Latitude: ${latitude}, Longitude: ${longitude}`) // Set initial popup content
        .openPopup();

    // Event listener to update latitude and longitude on marker drag
    marker.on("dragend", function (e) {
        const position = marker.getLatLng(); // Get new marker position
        latitude = position.lat; // Update latitude
        longitude = position.lng; // Update longitude

        // Update the latitude and longitude input fields
        document.querySelector("#lat").value = latitude;
        document.querySelector("#long").value = longitude;

        // Update the popup with new latitude and longitude
        marker
            .getPopup()
            .setContent(
                `Latitude: ${latitude.toFixed(
                    6
                )}, Longitude: ${longitude.toFixed(6)}`
            ) // Update popup content
            .openOn(map); // Reopen the updated popup
    });

    // Initialize input fields with default values
    document.querySelector("#lat").value = latitude;
    document.querySelector("#long").value = longitude;
}

// Geolocation function to update the map and marker based on user's location
const findMyLocation = () => {
    const success = (position) => {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;

        if (map !== undefined) {
            map.remove(); // Remove the existing map instance
        }

        // Reinitialize the map with the new location
        map = L.map("map").setView([latitude, longitude], 18);
        let googleStreets = L.tileLayer(
            "http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}",
            {
                maxZoom: 20,
                subdomains: ["mt0", "mt1", "mt2", "mt3"],
            }
        );
        googleStreets.addTo(map);

        // Add draggable marker for the new location
        marker = L.marker([latitude, longitude], { draggable: true })
            .addTo(map)
            .bindPopup(
                `Latitude: ${latitude.toFixed(
                    6
                )}, Longitude: ${longitude.toFixed(6)}`
            )
            .openPopup();

        // Add dragend event listener to update lat/lng and popup when marker is dragged
        marker.on("dragend", function (e) {
            const position = marker.getLatLng(); // Get new marker position
            latitude = position.lat; // Update latitude
            longitude = position.lng; // Update longitude

            // Update the latitude and longitude input fields
            document.querySelector("#lat").value = latitude;
            document.querySelector("#long").value = longitude;

            // Update the popup with new latitude and longitude
            marker
                .getPopup()
                .setContent(
                    `Latitude: ${latitude.toFixed(
                        6
                    )}, Longitude: ${longitude.toFixed(6)}`
                )
                .openOn(map); // Reopen the updated popup
        });

        // Update the latitude and longitude input fields
        document.querySelector("#lat").value = latitude;
        document.querySelector("#long").value = longitude;
    };

    const error = (err) => {
        console.log(err);
    };

    // Trigger geolocation lookup
    navigator.geolocation.getCurrentPosition(success, error);
};

// Initialize the map with default coordinates when the page loads
initMap();

// Add event listener for "Find My Location" button
document
    .querySelector("#find-my-location")
    .addEventListener("click", findMyLocation);

const fileInput = document.getElementById("image");
const previewImage = document.getElementById("preview-image");
fileInput.addEventListener("change", function (e) {
    const file = e.target.files[0]; // Get the uploaded file
    if (file) {
        const reader = new FileReader();

        reader.onload = function (event) {
            previewImage.src = event.target.result; // Set the image preview src
        };
        reader.readAsDataURL(file); // Read the file as a data URL
    }
});
