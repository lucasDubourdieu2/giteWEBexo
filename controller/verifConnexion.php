<?php
session_start(); 

include '../model/Tbq_client.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $mail = trim($_POST['mail']);
    $password = trim($_POST['password']);


    if (TbqClient::verifierConnexion($mail, $password)) {
        // La vérification de connexion est réussie
        $_SESSION['utilisateur_connecte'] = true; 
        $_SESSION['role'] = 'admin';
        header('Location: ../view/index.php'); 
        exit;
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
