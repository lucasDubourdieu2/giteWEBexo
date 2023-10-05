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
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/carouselPhoto.js"></script>
</head>

<body>
    <?php include '../includes/front-header.php'; ?>
    <div class="gestionCarousel">
        <h1 class="customTitle">Les images du gite :</h1>
        <div class="carousel-container">
            <div class="carousel">
                <?php foreach ($images as $index => $image) : ?>
                    <div class="carousel-slide <?= $index === 0 ? 'active' : ''; ?>">
                        <img src="<?= $image['image_url']; ?>" alt="<?= $image['image_alt']; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="carousel-text">
                <button id="prevCarouselBtn">Précédent</button>
                <p id="imageCounter">Image 1/<?= count($images); ?></p>
                <button id="nextCarouselBtn">Suivant</button>
            </div>
        </div>
    </div>
    <div class="intro">
    <h1 class="titreIntro">Figuiès</h1>
    <p class="introTarif"><strong>A partir de 550€ par semaine.</strong></p>
    </div>
    <div class="text-container">
        <p>
            Notre maison en pierre, située sur les hauteurs, entre vignes, falaises et le causse vous séduira par sa vue magnifique et son environnement agréable.
            <span class="hidden-text">
                A 20 mn de Rodez, 10 mn de Marcillac et 30 mn de Conques, vous êtes idéalement situés pour visiter quelques-uns des sites naturels ou culturels remarquables de l'Aveyron.
                Figuies est un hameau charmant, que l'on visite à pied. Une belle balade par un chemin, vous mènera de la cascade de la Roque, à celles de Salles-la source, en profitant de nombreux points de vue sur le paysage.
                On adore aussi le sentier à flanc de versant avec des passages en encorbellement creusé dans la roche ! Il nous fait pénétrer dans le paysage des falaises calcaires avec de beaux points de vue sur la vallée.
                Vous êtes sur le GR 62 de Rodez à Conques.
                Le gîte de Figuies, d'une superficie de 75 m² sur deux niveaux, a été entièrement rénové en 2021. Une agréable décoration allie un style contemporain et des matériaux naturels comme le bois et le rotin.
                Il se compose, au rez-de-chaussée d'une pièce lumineuse ouverte sur le paysage grâce à une grande baie vitrée. De 35 m² et climatisée, cet espace offre une cuisine moderne bien équipée, un séjour et un coin salon chaleureux et cosy.
                La terrasse plein sud, offre une vue imprenable sur la vallée que l'on peut contempler en prenant ses repas. Vous pourrez même admirer de superbes couchers du soleil.
                A l'étage, vous disposerez de deux chambres mansardées et confortables. L'une avec un lit en 140/190 et l'autre avec deux lits en 90/190. Vous y trouverez aussi la salle de bain avec son WC.
                Le jardin, très agréable, est non clos. Pourvu d'un bar extérieur, d'un barbecue, d'un évier et de mobilier de jardin, vous pourrez y prendre vos repas ou vous reposer à l'ombre de la glycine. Un WC et une douche complètent l'équipement.
                Pour des vacances authentiques et au grand air, dans un lieu paisible à l'écart de la circulation, vous vous sentirez chez vous tout en étant dépaysé.
            </span>
        </p>
        <p><a href="#" id="readMoreLink" class="enSavoirPlus">En savoir plus</a></p>
    </div>
    <div class="capacite">
        <hr>
        <h2>Capacité</h2>
        <li>Personne : 4</li>
        <li>Chambre : 2</li>
        <li>Personne (maximum) : 4</li>
    </div>
    <div class="equipement">
        <hr>
        <h2>Equipements et services</h2>
    </div>
    <div class="langues">
        <hr>
        <h2>Langues</h2>
        <img class="iconFlag" src="../img/france.png">
    </div>
    <div class="tarifs">
        <hr>
        <h2>Tarifs</h2>
        <ul>
            <li><strong>Moyenne saison</strong> à 550€</li>
            <li><strong>Nuitée Moyenne saison</strong> à 85€</li>
            <li><strong>Semaine Haute Saison</strong> à 650€</li>
            <li><strong>Nuitée Haute Saison</strong> à 110€</li>
        </ul>
    </div>
    <div class="moyenPayement">
        <hr>
        <h2>Moyen de payement</h2>
        <li>Chèque</li>
        <li>Espèce</li>
        <li>Virement</li>
    </div>
    <div class="disponibilites">
        <hr>
        <h2>Disponibilités</h2>
        <p>Ouverture à partir du 01/04/2023 jusqu'au 30/10/2023</p>
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
            event.preventDefault(); // Empêcher le comportement par défaut du lien

            if (!isExpanded) {
                hiddenText.style.display = "block"; // Afficher le texte complet
                readMoreLink.textContent = "Voir moins";
            } else {
                hiddenText.style.display = "none"; // Cacher le texte excédentaire
                readMoreLink.textContent = "En savoir plus";
            }

            isExpanded = !isExpanded;
        });
    });
</script>