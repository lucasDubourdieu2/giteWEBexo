<!DOCTYPE html>
<html>

<head>
    <title>Site web Le gite</title>
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/connexion.css">
</head>

<body>
    <?php include '../includes/front-header.php'; ?>
    <div class="centered-content">
        <div class="container">
            <h1>Connexion</h1>
            <form action="../controller/verifConnexion.php" method="POST">
                <input type="text" name="mail" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>
            <?php
            if (!empty($_SESSION['erreurConnexion'])) { ?>
                <p class="msgErreur"><?php echo $_SESSION['erreurConnexion']; ?></p>
                <?php $_SESSION['erreurConnexion'] = "" ?>
            <?php } ?>
            <p>Pas encore de compte ? <a href="../view/inscription.php" class="lienInscription">Inscrivez-vous</a></p>
        </div>
    </div>
    <?php include '../includes/front-footer.php'; ?>
</body>

</html>