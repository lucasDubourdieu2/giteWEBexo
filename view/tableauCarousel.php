<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/carousel.css">
</head>
<body>
    <h1>Galerie d'images</h1>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Chemin de l'image</th>
                <th>Descriptif de l'image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("../model/db-config.php");
            include("../model/Tbq_visuel.php");

            // Créer une instance de TbqVisuel avec la connexion à la base de données
            $tbqVisuel = new TbqVisuel($conn);

            // Récupérer les images depuis la base de données
            $images = $tbqVisuel->getImagesFromDatabase("id, image_url, image_alt");

            // Générer les lignes de tableau pour chaque image
            foreach ($images as $image) {
                echo "<tr>";
                echo "<td><img src=" . $image['image_url'] . " alt=". $image['image_alt'] ." class='previewCarousel'></td>";
                echo "<td>" . $image['image_url'] . "</td>";
                echo "<td>" . $image['image_alt'] . "</td>";
                echo "<td><a href=\"../controller/deleteImage.php?id=" . $image['id'] . "\" class='suppresion'>Supprimer</a></td>";
                echo "</tr>";
            }            
            ?>
        </tbody>
    </table>
</body>
</html>
