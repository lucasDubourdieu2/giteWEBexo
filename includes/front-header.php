<?php
session_start();
?>

<header>
    <nav>
        <ul class="menu">
            <li class="logo"><a class="lienMenu" href="../view/index.php"><img src="../img/logo.png" alt="Logo Gite" style="width: 60px; height: auto;"></a></li>
            <li class="item"><a class="lienMenu" href="../view/index.php">Accueil</a></li>
            <li class="item"><a class="lienMenu" href="../view/disponibilites.php">Disponibilités</a></li>
            <li class="item"><a class="lienMenu" href="../view/coordonnees.php">Coordonnées</a></li>

            <?php
            // Vérifiez l'état de la session
            if (isset($_SESSION['utilisateur_connecte']) && $_SESSION['utilisateur_connecte'] === true) {
                // Vérifiez le rôle de l'utilisateur
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            ?>
                    <li class="item"><a class="lienMenu" href="../view/uploadCarousel.php">Panel Carousel</a></li>
            <?php
                }
            ?>
                <li class="item button"><a class="lienMenu" href="../controller/deconnexion.php">Déconnexion</a></li>
            <?php } else {
            ?>
                <li class="item button"><a class="lienMenu" href="../view/connexion.php">Connexion</a></li>
                <li class="item button secondary"><a class="lienMenu" href="../view/inscription.php">Inscription</a></li>
            <?php
            }
            ?>

            <li class="toggle"><span class="bars"></span></li>
        </ul>
    </nav>
</header>
