<?php
session_start(); 

include '../model/Tbq_client.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $mail = trim($_POST['mail']);
    $password = trim($_POST['password']);

    // Vérifiez les informations d'identification de base
    if (TbqClient::verifierConnexion($mail, $password)) {
        // La vérification de connexion est réussie, récupérez le rôle de l'utilisateur
        $role = TbqClient::getRoleByEmail($mail);

        if ($role === 'admin') {
            // L'utilisateur est un administrateur
            $_SESSION['utilisateur_connecte'] = true;
            $_SESSION['role'] = 'admin';
            header('Location: ../view/index.php');
            exit;
        } else {
            // L'utilisateur n'est pas un administrateur
            $_SESSION['utilisateur_connecte'] = true;
            header('Location: ../view/index.php');
            exit;
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>