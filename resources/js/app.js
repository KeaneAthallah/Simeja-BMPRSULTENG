import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

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
