<?php

session_start(); 

include '../model/tbq_calendrier.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tbqCalendrier = new tbqCalendrier($conn);
     // Récupérez les données du formulaire
     $nom = trim($_POST['nom']);
     $dateDeb = trim($_POST['dateDeb']);
     $dateFin = trim($_POST['dateFin']);
   

    if (isset($_POST['supprimer'])) {

        if($tbqCalendrier->supDateCalendrier($nom, $dateDeb, $dateFin)) {
            header('Location: ../view/disponibilites.php'); 
            exit;
        }  else {
            echo "Erreur d'enregistrement de la reservation ! ";
        }
    } else {

  
        if ($tbqCalendrier->insertDateCalendrier($nom, $dateDeb, $dateFin)) {
            header('Location: ../view/disponibilites.php'); 
            exit;
        }  else {
            echo "Erreur d'enregistrement de la reservation ! ";
        }
    }
}
?>
