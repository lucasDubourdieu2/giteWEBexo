<?php
session_set_cookie_params(1200);
session_start();
?>
<header class="header">
  <nav>
    <div class="logo">
      <a href="../index.php"><img src="../img/logo.png" alt="Logo Gite" ></a>
    </div>
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-icon">&#9776;</label>
    <ul class="menu">
      <li><a href="../index.php">Accueil</a></li>
      <li><a href="../view/disponibilites.php">Disponibilités</a></li>
      <li><a href="../view/coordonnees.php">Coordonnées</a></li>
      <?php
            if (isset($_SESSION['utilisateur_connecte']) && $_SESSION['utilisateur_connecte'] === true) {
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            ?>
                    <li class="item"><a class="lienMenu" href="../view/uploadCarousel.php">Panel Carrousel</a></li>
                    <li class="item"><a class="lienMenu" href="../view/formAccueil.php">Gérer la page d'accueil</a></li>
                    <li class="item"><a class="lienMenu" href="../view/gestionNewsletter.php">Gérer newsletter</a></li>
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
    </ul>
  </nav>
</header>