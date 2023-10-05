<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pannel admin carousel</title>
    <link rel="stylesheet" href="../css/carousel.css">
</head>
<body>
<a href="../view/index.php">Accueil</a>
<h1>Page administrateur de la gestion d'images du carousel</h1>
    <form action="../controller/upload_handler.php" method="POST" enctype="multipart/form-data">
        <h2>Mise en ligne d'une nouvelle image</h2>
    <label for="image">Sélectionnez une image :</label>
        <input type="file" name="image" id="image">
        <br>
        <label for="image_alt">Texte descriptif :</label>
        <input type="text" name="image_alt" id="image_alt">
        <br>
        <input type="submit" name="upload" value="Télécharger">
    </form>
    <?php include('../view/tableauCarousel.php');?>
</body>
</html>
