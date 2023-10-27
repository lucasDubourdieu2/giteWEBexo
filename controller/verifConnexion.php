<?php
session_set_cookie_params(1200);
session_start(); 

include '../model/Tbq_client.php';
$_SESSION['erreurConnexion'] = ""; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $mail = trim($_POST['mail']);
    $password = trim($_POST['password']);


    if (TbqClient::verifierConnexion($mail, $password)) {
        $role = TbqClient::getRoleByEmail($mail);
        if ($role === 'admin') {
            $_SESSION['utilisateur_connecte'] = true; 
            $_SESSION['role'] = 'admin';
            header('Location: ../view/index.php'); 
            exit;
        }else{
            $_SESSION['utilisateur_connecte'] = true; 
            header('Location: ../view/index.php'); 
            exit;
        }
    } else {
        $_SESSION['erreurConnexion'] = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
header('Location: ../view/connexion.php'); 
exit;
