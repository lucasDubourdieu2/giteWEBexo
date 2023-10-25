<?php

session_start(); 

include '../model/tbq_calendrier.php';

$_SESSION['erreurCalendrier'] = ""; // message affiche si probleme d'insertion/suppression
$_SESSION['validCalendrier'] = ""; // message affiche si l'insertion/suppression a fonctionné

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tbqCalendrier = new tbqCalendrier($conn);
     // Récupérez les données du formulaire
     $nom = trim($_POST['nom']);
     $dateDeb = trim($_POST['dateDeb']);
     $dateFin = trim($_POST['dateFin']);

     if ($tbqCalendrier->dateExist($nom, $dateDeb, $dateFin)) {
        if (isset($_POST['supprimer'])) {
            if ($tbqCalendrier->supDateCalendrier($nom, $dateDeb, $dateFin)) {
                $_SESSION['validCalendrier'] =  "La suppression de la réservation a bien été effectué";
                header('Location: ../view/disponibilites.php');
                exit;
            }
        } else {
            // Cas d'un ajout alors que la reservartion existe déjà
            $_SESSION['erreurCalendrier'] =  "Une réservation existe déjà pour ces dates !";
            header('Location: ../view/disponibilites.php');
            exit;
        }
    } else {
        if (isset($_POST['ajouter'])) {
            if ($tbqCalendrier->insertDateCalendrier($nom, $dateDeb, $dateFin)) {
                $_SESSION['validCalendrier'] = "La reservation a bien été enregistré";
                header('Location: ../view/disponibilites.php');
                exit;
            } 
        } else {
            // Cas d'une suppression alors que la réservation n'existe pas
            $_SESSION['erreurCalendrier'] =  "Aucune réservation n'exise pour ces dates !";
            header('Location: ../view/disponibilites.php');
            exit;
        }
    }
    

   
}
?>
