<?php
include("../model/db-config.php");
include("../model/Tbq_visuel.php");

// Créer une instance de TbqVisuel avec la connexion à la base de données
$tbqVisuel = new TbqVisuel($conn);

// Appeler la méthode pour récupérer les images
$images = $tbqVisuel->getImagesFromDatabase("id, image_url, image_alt");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Site web Le gite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/carouselPhoto.js"></script>
</head>

<body>    
    <?php include '../includes/front-header.php'; ?>
    <div class="corpsPage">
        <div class="carousel">
            <div class="slideshow-container">

                <h1 class="customTitle">Le gite Figuiès</h1>
                <?php foreach ($images as $index => $image) : ?>
                    <div class="mySlides fade">
                        <div class="numbertext"><p id="imageCounter"><?= count($images); ?></p></div>
                        <img src="<?= $image['image_url']; ?>" alt="<?= $image['image_alt']; ?>" style="width:100%">
                    </div>
                    
                <?php endforeach; ?>   

                <div class="navigation-container">
                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>
                </div>
            </div>

        </div>
    
        <div class="gestionIntro">
            <div class="intro">
                <h1 class="titreIntro">Figuiès</h1>
                <p class="introTarif" id="modif_tarifAccroche"></p>
            </div>
            <div class="text-container">
                <p class="customText" id="modif_introAccroche"></p>
                <span class="hidden-text" id="modif_intro"></span>
                <p class="customText"><a href="#" id="readMoreLink" class="enSavoirPlus">En savoir plus</a></p>
            </div>
        </div>
        <div class="corpsPage">
            </div>
                <div class="conteneurflex">
                    <div class="capacite">
                        <div class="gestionCapacite">
                            <h2 class="customTitre">Capacité</h2>
                            <p id="modif_capacite"></p>
                        </div>
                    </div>
                    <div class="equipement">
                        <div class="gestionEquipement">
                            <h2 class="customTitre">Equipements et services</h2>
                            <p id="modif_equipementEtService"></p>
                        </div>
                    </div>
                </div>
                <div class="conteneurflex">
                    <div class="langues">
                        <div class="gestionLangue">
                            <h2 class="customTitre">Langues</h2>
                            <p id="modif_langue"></p>
                        </div>
                    </div>
                    <div class="tarifs">
                        <div class="gestionTarifs">
                            <h2 class="customTitre">Tarifs</h2>
                            <p id="modif_tarifs"></p>
                        </div>
                    </div>
                </div>
                <div class="conteneurflex">
                    <div class="moyenPayement">
                        <div class="gestionPayement">
                            <h2 class="customTitre">Moyen de payement</h2>
                            <p id="modif_MoyenDePaiement"></p>
                        </div>
                    </div>
                    <div class="disponibilites">
                        <div class="gestionDispo">
                            <h2 class="customTitre">Saison</h2>
                            <p id="modif_saison"></p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php include '../includes/front-footer.php'; ?>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hiddenText = document.querySelector(".text-container .hidden-text");
        const readMoreLink = document.getElementById("readMoreLink");
        let isExpanded = false;

        readMoreLink.addEventListener("click", function(event) {
            event.preventDefault();

            if (!isExpanded) {
                hiddenText.style.display = "block";
                readMoreLink.textContent = "Voir moins";
            } else {
                hiddenText.style.display = "none";
                readMoreLink.textContent = "En savoir plus";
            }

            isExpanded = !isExpanded;
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        var modif_tarifAccroche = document.getElementById("modif_tarifAccroche");
        var modif_introAccroche = document.getElementById("modif_introAccroche");
        var modif_intro = document.getElementById("modif_intro");
        var modif_capacite = document.getElementById("modif_capacite");
        var modif_equipementEtService = document.getElementById("modif_equipementEtService");
        var modif_langue = document.getElementById("modif_langue");
        var modif_tarifs = document.getElementById("modif_tarifs");
        var modif_MoyenDePaiement = document.getElementById("modif_MoyenDePaiement");
        var modif_saison = document.getElementById("modif_saison");

        // Fonction pour effectuer la requête AJAX
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../controller/get_latest_accueil.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    if (data) {
                        modif_tarifAccroche.innerHTML = data.tarifAccroche;
                        modif_introAccroche.innerHTML = data.introAccroche;
                        modif_intro.innerHTML = data.intro;
                        modif_capacite.innerHTML = data.capacite;
                        modif_equipementEtService.innerHTML = data.equipementEtService;
                        modif_langue.innerHTML = data.langue;
                        modif_tarifs.innerHTML = data.tarifs;
                        modif_MoyenDePaiement.innerHTML = data.moyenDePaiement;
                        modif_saison.innerHTML = data.saison;
                    }
                }
            };
            xhr.send();
        }
        fetchData();
    });

</script>


<script>
            let slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
            showSlides(slideIndex += n);
            }

            function currentSlide(n) {
            showSlides(slideIndex = n);
            }

            function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            }
</script>