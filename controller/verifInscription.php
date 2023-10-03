<?php
include 'model/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $newsletter = isset($_POST['newsletter']) ? $_POST['newsletter'] : 0;

    // Validation côté serveur
    // if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&!])[A-Za-z\d@#$%^&!]{12,}$/', $password)) {
    //     header('Location: inscription.php?error=password');
    //     exit;
    // }

        // Validation pour le mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: inscription.php?error=mail');
        exit;
    }

    // Validation pour le nom
    if (!preg_match('/^[A-Za-z]{1,32}$/', $nom)) {
        header('Location: inscription.php?error=nom');
        exit;
    }

        // Validation pour le prenom
    if (!preg_match('/^[A-Za-z]{1,32}$/', $prenom)) {
        header('Location: inscription.php?error=prenom');
        exit;
    }

        // Validation pour le pseudo
    if (!preg_match('/^[A-Za-z0-9_]{1,32}$/', $username)) {
        header('Location: inscription.php?error=username');
        exit;
    }
    // Préparez une requête d'insertion avec une déclaration préparée
    $query = "INSERT INTO utilisateur (username, nom, prenom, mail, mot_de_passe, newsletter) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Créez une déclaration préparée
    $stmt = $conn->prepare($query);
    
    // Liez les paramètres
    $stmt->bind_param("sssssi", $username, $nom, $prenom, $email, $password, $newsletter);
    
    // Exécutez la déclaration préparée
    if ($stmt->execute()) {
        echo "Inscription réussie!";
        header('Location: index.php');
    } else {
        echo "Erreur lors de l'inscription : " . $stmt->error;
        header('Location: inscription.php');
    }

    // Fermez la déclaration préparée et la connexion lorsque vous avez terminé
    $stmt->close();
    $conn->close();
}
