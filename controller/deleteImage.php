<?php
include("../model/db-config.php");
include("../model/Tbq_visuel.php");

// Récupérer l'ID de l'image à supprimer depuis l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance de TbqVisuel avec la connexion à la base de données
    $tbqVisuel = new TbqVisuel($conn);

    // Obtenir le chemin du fichier à supprimer depuis la base de données
    $imagePath = $tbqVisuel->getImagePathById($id);

    if ($imagePath) {
        // Supprimer le fichier du répertoire
        if (unlink($imagePath)) {
            // Si la suppression du fichier réussit, supprimez également l'entrée de la base de données
            if ($tbqVisuel->deleteImage($id)) {
                header('Location: ../view/uploadCarousel.php');
            } else {
                header('Location: ../view/uploadCarousel.php?errorSuppression');
            }
        } else {
            header('Location: ../view/uploadCarousel.php?errorSuppressionFichier');
        }
    } else {
        header('Location: ../view/uploadCarousel.php?errorImageNonTrouvee');
    }
} else {
    header('Location: ../view/uploadCarousel.php?errorID');
}
?>  