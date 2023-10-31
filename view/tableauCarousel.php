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
            <?php
            if (!empty($_SESSION['suppressionOK'])) { ?>
                <p class="msgValid"><?php echo $_SESSION['suppressionOK']; ?></p>
            <?php $_SESSION['suppressionOK'] = "";
            } elseif (!empty($_SESSION['suppressionErreur'])) { ?>
                <p class="msgErreur"><?php echo $_SESSION['suppressionErreur']; ?></p>
            <?php $_SESSION['suppressionErreur'] = "";
            } elseif (!empty($_SESSION['suppressionErreurFichier'])) { ?>
                <p class="msgErreur"><?php echo $_SESSION['suppressionErreurFichier']; ?></p>
            <?php $_SESSION['suppressionErreurFichier'] = "";
            } elseif (!empty($_SESSION['erreurPasImage'])) { ?>
                <p class="msgErreur"><?php echo $_SESSION['erreurPasImage']; ?></p>
            <?php $_SESSION['erreurPasImage'] = "";
            } elseif (!empty($_SESSION['erreurID'])) { ?>
                <p class="msgErreur"><?php echo $_SESSION['erreurID']; ?></p>
            <?php $_SESSION['erreurID'] = "";
            } ?>
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
                    echo "<td><img src=" . $image['image_url'] . " alt=" . $image['image_alt'] . " class='previewCarousel' loading='lazy'></td>";
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