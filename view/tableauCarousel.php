<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/carousel.css">
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
</head>
<body>
    <h1 class="titre">Galerie d'images</h1>
    <div class="tableauflex">
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

                $tbqVisuel = new TbqVisuel($conn);

                $images = $tbqVisuel->getImagesFromDatabase("id, image_url, image_alt");

                // Génère les lignes du tableau pour chaque image
                foreach ($images as $image) {
                    echo "<tr>";
                    echo "<td><img src=" . $image['image_url'] . " alt=". $image['image_alt'] ." class='previewCarousel'></td>";
                    echo "<td>" . $image['image_url'] . "</td>";
                    echo "<td>" . $image['image_alt'] . "</td>";
                    echo "<td><a href=\"../controller/deleteImage.php?id=" . $image['id'] . "\" class='suppression'>Supprimer</a></td>";
                    echo "</tr>";
                }            
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
