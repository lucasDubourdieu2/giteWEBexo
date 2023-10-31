<?php
session_start();
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
                $_SESSION['suppressionOK'] = "L'image a bien été suprimmée";
                header('Location: ../view/uploadCarousel.php');
                exit;
            } else {
                $_SESSION['suppressionErreur'] = "Une erreur est intervenue lors de la suppression, veuillez recommencer";
                header('Location: ../view/uploadCarousel.php');
                exit;
            }
        } else {
            $_SESSION['suppressionErreurFichier'] = "Une erreur est intervenue lors de l'image', veuillez recommencer";
            header('Location: ../view/uploadCarousel.php');
            exit;
        }
    } else {
        $_SESSION['erreurPasImage'] = "Aucune image a été trouver, veuillez recommencer";
        header('Location: ../view/uploadCarousel.php');
        exit;
    }
} else {
    $_SESSION['erreurID'] = "Une erreur est intervenue lors de la suppression, veuillez recommencer";
    header('Location: ../view/uploadCarousel.php');
    exit;
}
?>  