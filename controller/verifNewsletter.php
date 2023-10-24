<?php
include '../model/db-config.php';
include '../model/Tbq_newsletter.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $tbqNewsletter = new TbqNewsletter($conn);

    $result = $tbqNewsletter->insererAbonner($nom, $email);

    echo $result;
}
