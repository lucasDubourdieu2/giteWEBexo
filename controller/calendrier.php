<?php

session_start(); 

//include '../model/db-config.php';
include '../model/Tbq_visuel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TbqVisuel = new TbqVisuel($conn);

    
    // Récupérez les données du formulaire
    $nom = trim($_POST['nom']);
    $dateDeb = trim($_POST['dateDeb']);
    $dateFin = trim($_POST['dateFin']);
  
    if($TbqVisuel->insertDateCalendrier($nom, $dateDeb, $dateFin)) {
        header('Location: ../view/index.php'); 
        exit;
    }  else {
        echo "Erreur d'enregistrement de la reservation ! ";
    }

}

?>
