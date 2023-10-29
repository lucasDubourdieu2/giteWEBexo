<?php
session_set_cookie_params(1200);
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
            // Chemin du répertoire "img"
            $upload_directory = "../img/";

            // Créez une instance de TbqVisuel avec la connexion à la base de données
            $tbqVisuel = new TbqVisuel($conn);

            if (move_uploaded_file($image_tmp, $upload_directory . 'original/' . $image_name)) {
                // L'upload a réussi, renommez l'image avec l'ID
                $image_id = $tbqVisuel->insertImage($upload_directory . 'original/' . $image_name, $image_alt);

                if ($image_id) {
                    // Renommez l'image en fonction de l'ID
                    $desktop_image_name = "figures-" . $image_id . "-desktop." . $file_extension;
                    $mobile_image_name = "figures-" . $image_id . "-mobile." . $file_extension;

                    // Redimensionnez l'image en version desktop (400x400)
                    resizeImage($upload_directory . 'original/' . $image_name, $upload_directory . 'resizeImg/desktop/' . $desktop_image_name, 400, 400);

                    // Redimensionnez l'image en version mobile (200x200)
                    resizeImage($upload_directory . 'original/' . $image_name, $upload_directory . 'resizeImg/mobile/' . $mobile_image_name, 200, 200);

                    // Mettre à jour le nom de l'image dans la base de données
                    $tbqVisuel->updateImageName($image_id, $desktop_image_name, $mobile_image_name);

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
        $_SESSION['erreurPasImage'] = "Une erreur est intervenu, veuillez recommencer";
        header('Location: ../view/uploadCarousel.php');
        exit;
    }
}

// Fonction pour redimensionner l'image
function resizeImage($sourcePath, $destinationPath, $width, $height) {
    list($origWidth, $origHeight) = getimagesize($sourcePath);
    $source = imagecreatefromstring(file_get_contents($sourcePath));
    $image = imagecreatetruecolor($width, $height);

    imagecopyresampled($image, $source, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);

    // Enregistrez l'image redimensionnée au format JPEG ou PNG en fonction de l'extension d'origine
    $fileExtension = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
    if ($fileExtension === 'jpg' || $fileExtension === 'jpeg') {
        imagejpeg($image, $destinationPath);
    } elseif ($fileExtension === 'png') {
        imagepng($image, $destinationPath);
    }

    imagedestroy($source);
    imagedestroy($image);
}
