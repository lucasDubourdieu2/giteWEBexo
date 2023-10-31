<!DOCTYPE html>
<html>

<head>
    <title>Site web Le gite</title>
    <link rel="icon" href="../img/logo/icone.png" type="image/png">
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/newsletter.css">
</head>

<body>
    <?php include '../includes/front-header.php'; ?>
    <div class="centered-content">
        <div class="container">
            <h1 class="title">Inscription à la Newsletter</h1>
            <p>Recevez nos dernières mises à jour par e-mail en vous inscrivant à notre newsletter.</p>
            <br>
            <form action="../controller/verifNewsletter.php" method="post">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
                <br>
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" required>
                <br>
                <input type="checkbox" id="consentement" name="consentement" required>
                <label for="consentement" >Je consens à recevoir des e-mails de la newsletter.</label>
                <br>
                <input type="submit" class="btnNewsletter" value="S'inscrire">
            </form>
        </div>
    </div>
    <?php include '../includes/front-footer.php'; ?>
</body>

</html>