<?php
session_start();
include("../model/db-config.php");
include("../model/Tbq_visuel.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $tbqVisuel = new TbqVisuel($conn);

    // Obtenir le chemin du fichier à supprimer depuis la base de données
    $imagePath = $tbqVisuel->getImagePathById($id);

    if ($imagePath) {
        if (unlink($imagePath)) {
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
