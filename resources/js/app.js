import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    const loading = document.querySelector(".loading"); // Asegúrate de que sea .loading

    // Mostrar el spinner cuando la página está cargando
    window.addEventListener("beforeunload", function () {
        loading.classList.remove("hidden");
    });

    // Ocultar el spinner cuando la página ha cargado
    window.addEventListener("load", function () {
        loading.classList.add("hidden");
    });
});
