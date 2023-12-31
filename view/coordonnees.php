<!DOCTYPE html>
<html>

<head>
    <title>Site web Le gite</title>
    <meta name="keywords" content="gite, Aveyron, Rodez, reservation, location, famille, coordonnees, mail, numéro téléphone">
    <meta name="description" content="Le gite Figuiès en Aveyron">
    <link rel="icon" href="../img/logo/icone.png" type="image/png">
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/coordonnees.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
</head>

<body>
    <?php include '../includes/front-header.php'; ?>
    <main>
        <div class="corpsPage">
            <address class="coord">
                <div class="coor-container">
                    <div class="coordonnees">
                        <h1>Coordonnées</h1>
                        <br>
                        <ul>
                            <li>
                                <span class="icon"><i class="fas fa-phone"></i></span>
                                +33(0) 6 41 57 73 20
                            </li>
                            <br>
                            <li>
                                <span class="icon"><i class="fab fa-facebook"></i></span>
                                <a class="lienCoordonnees" href="https://www.facebook.com/gitefiguies"> gitefiguies </a>
                            </li>
                            <br>
                            <li>
                                <span class="icon"><i class="fas fa-envelope"></i></i></span>
                                <a class="lienCoordonnees" href="mailto:beatrice.boyer29@orange.fr">beatrice.boyer29@orange.fr</a>
                            </li>
                        </ul>
                    </div>

                    <div class="adresse">
                        <h1>Adresse</h1>
                        <br>
                        <ul>
                            <li>Figuiès </li>
                            <br>
                            <li> 140 rue de Figuiès</li>
                            <br>
                            <li>12330 Salles-la-Source</li>
                        </ul>

                    </div>
                </div>
                <div class="carte">
                    <h1 class="titreMap">Nous retrouver facilement</h1>
                    <div id="map"></div>
                    <script type="module" src="../js/carte.js"></script>
                    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

                </div>
            </address>
        </div>
    </main>
    <?php include '../includes/front-footer.php'; ?>
</body>

</html>