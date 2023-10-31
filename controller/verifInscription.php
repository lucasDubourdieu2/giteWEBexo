<?php
include '../model/db-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validation pour le mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../view/inscription.php?error=mail');
        exit;
    }

    // Validation pour le nom
    if (!preg_match('/^[A-Za-z]{1,32}$/', $nom)) {
        header('Location: ../view/inscription.php?error=nom');
        exit;
    }

    // Validation pour le prenom
    if (!preg_match('/^[A-Za-z]{1,32}$/', $prenom)) {
        header('Location: ../view/inscription.php?error=prenom');
        exit;
    }

    // Validation pour le pseudo
    if (!preg_match('/^[A-Za-z0-9_]{1,32}$/', $username)) {
        header('Location:../view/inscription.php?error=username');
        exit;
    }

    // Vérification si l'adresse e-mail existe déjà en base de données
    $query_check_email = "SELECT COUNT(*) FROM client WHERE mail = ?";
    $stmt_check_email = $conn->prepare($query_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $stmt_check_email->bind_result($email_count);
    $stmt_check_email->fetch();
    $stmt_check_email->close();

    if ($email_count > 0) {
        header('Location: ../view/inscription.php?error=email_exists');
        exit;
    }

    $query_insert = "INSERT INTO client (username, nom, prenom, mail, mot_de_passe) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($query_insert);
    $stmt_insert->bind_param("sssss", $username, $nom, $prenom, $email, $password);

    if ($stmt_insert->execute()) {
        echo "Inscription réussie!";
        header('Location: ../view/index.php');
    } else {
        echo "Erreur lors de l'inscription : " . $stmt_insert->error;
        header('Location: ../view/inscription.php');
    }

    $stmt_insert->close();
    $conn->close();
}
