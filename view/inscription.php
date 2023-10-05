<!DOCTYPE html>
<html>

<head>
    <title>Site web Le gite</title>
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/connexion.css">
    <script src="../js/validateForm.js"></script>
</head>

<body>
    <?php include '../includes/front-header.php'; ?>
    <div class="centered-content">
        <div class="container">
            <h1>Inscription</h1>
            <form action="../controller/verifInscription.php" method="POST" onsubmit="return validateFormInscription();">
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required>
                <input type="text" name="nom" id="nom" placeholder="Nom" required>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
                <input type="email" name="email" id="email" placeholder="Adresse e-mail" required>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <button type="submit">S'inscrire</button>
            </form>
            <p>Déjà un compte ? <a href="../view/connexion.php" class="lienInscription">Connectez-vous</a></p>
        </div>
    </div>
    <?php include '../includes/front-footer.php'; ?>
</body>

</html>