document.addEventListener("DOMContentLoaded", function () {
    var currentIndex = 0;
    var images = document.querySelectorAll(".carousel-slide");
    var imageCounter = document.getElementById("imageCounter");

    function updateCarousel() {
        // Masquer toutes les images
        images.forEach(function (image) {
            image.style.display = "none";
        });

        // Afficher l'image actuelle
        images[currentIndex].style.display = "block";

        // Mettre à jour le compteur d'image
        imageCounter.textContent = "Image " + (currentIndex + 1) + "/" + images.length;
    }

    // Gestionnaire de clic sur le bouton "Suivant"
    document.getElementById("nextCarouselBtn").addEventListener("click", function () {
        currentIndex++;
        if (currentIndex >= images.length) {
            currentIndex = 0;
        }
        updateCarousel();
    });

    // Gestionnaire de clic sur le bouton "Précédent"
    document.getElementById("prevCarouselBtn").addEventListener("click", function () {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = images.length - 1;
        }
        updateCarousel();
    });

    updateCarousel(); // Appel initial pour afficher la première image
});
