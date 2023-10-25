<?php
session_start(); 

include("../model/db-config.php");
include("../model/Tbq_visuel.php");

$_SESSION['imageOk'] = ""; 
$_SESSION['erreurInsertion'] = ""; 
$_SESSION['erreurTelechargement'] = ""; 
$_SESSION['erreurExtension'] = ""; 
$_SESSION['erreurPasImage'] = ""; 

if (isset($_POST['upload'])) {
    // Vérifier si un fichier a été sélectionné
    if (isset($_FILES['image'])) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_alt = $_POST['image_alt'];

        // Obtenez l'extension du fichier
        $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);

        // Liste des extensions d'images autorisées
        $allowed_extensions = array('jpg', 'png');

        // Vérifiez si l'extension est autorisée
        if (in_array(strtolower($file_extension), $allowed_extensions)) {
            // L'extension est valide, déplacez l'image téléchargée dans le répertoire "img"
            $upload_directory = "../img/"; // Chemin du répertoire "img"

            // Créez une instance de TbqVisuel avec la connexion à la base de données
            $tbqVisuel = new TbqVisuel($conn);

            if (move_uploaded_file($image_tmp, $upload_directory . $image_name)) {
                // L'upload a réussi, ajoutez le lien de l'image en base de données
                if ($tbqVisuel->insertImage($upload_directory . $image_name, $image_alt)) {
                    // Récupérez l'ID de l'image après l'insertion
                    $image_id = $tbqVisuel->getLastInsertedId();

                    // Renommez l'image avec l'ID
                    $new_image_name = "../img/carousel/figure-" . $image_id . "." . $file_extension;
                    rename($upload_directory . $image_name, $upload_directory . $new_image_name);

                    // Mettez à jour le nom de l'image dans la base de données
                    $tbqVisuel->updateImageName($image_id, $new_image_name);
                    $_SESSION['imageOk'] = "L'image a bien été mise en ligne";
                    header('Location: ../view/uploadCarousel.php');
                    exit;
                } else {
                    $_SESSION['erreurInsertion'] = "Une erreur lors de l'insertion de l'image est arrivée, veuillez recommencer";
                    header('Location: ../view/uploadCarousel.php');
                    exit;
                }
            } else {
                $_SESSION['erreurTelechargement'] = "Une erreur lors du téléchargement de l'image est arrivée, veuillez recommencer";
                header('Location: ../view/uploadCarousel.php');
                exit;
            }
        } else {
            $_SESSION['erreurExtension'] = "L'image n'utilise pas la bonne extension, veuillez utiliser un .jpg ou .png";
            header('Location: ../view/uploadCarousel.php');
            exit;
        }
    } else {
        $_SESSION['erreurExtension'] = "Une erreur est intervenu, veuillez recommencer";
        header('Location: ../view/uploadCarousel.php');
        exit;
    }
}
?>