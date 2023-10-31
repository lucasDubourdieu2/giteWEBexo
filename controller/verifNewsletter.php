<?php
session_start();
include '../model/db-config.php';
include '../model/Tbq_newsletter.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $tbqNewsletter = new TbqNewsletter($conn);

    $result = $tbqNewsletter->insererAbonner($nom, $email);

    if ($result === "emailValide") {
        $_SESSION['emailValide'] = "L'inscription a bien été effectuée";
    } elseif ($result === "emailDejaUtilise") {
        $_SESSION['emailDejaUtiliser'] = "L'e-mail saisi a déjà été enregistré";
    } else {
        $_SESSION['erreurInscription'] = "Une erreur est survenue lors de l'inscription, veuillez réessayer";
    }

    header('Location: ../view/newsletter.php');
    exit;
}
