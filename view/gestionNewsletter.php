<!DOCTYPE html>
<html>

<head>
    <title>Site web Le gite</title>
    <link rel="stylesheet" href="../css/newsletterAdmin.css">
</head>

<body>
    <a href="../view/index.php">Accueil</a>
    <h1 class="titleNewsletter">Page administrateur de la gestion de la newsletter</h1>
    <form action="../controller/dlNewsletter.php" method="POST" enctype="multipart/form-data">
    <h2>Téléchargement des mails éligibles</h2>
    <input type="hidden" name="download" value="1">
    <input type="submit" value="Télécharger">
</form>

</body>

</html>