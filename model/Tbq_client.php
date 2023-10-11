<?php
include("../model/db-config.php");

class TbqClient {

    public static function verifierConnexion($mail, $password) {
        global $conn; // Pour accéder à la connexion dans db_config.php
        $query = "SELECT mot_de_passe FROM client WHERE mail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $mail);

        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($hashedPasswordFromDatabase);
                $stmt->fetch();

                // Utilisez password_verify pour comparer le mot de passe saisi avec le hachage stocké
                if (password_verify($password, $hashedPasswordFromDatabase)) {
                    return true; // Connexion réussie
                }
            }
        }
        return false; // Échec de la connexion
    }

    public static function getRoleByEmail($email)
{
    include("db-config.php");

    // Préparez la requête SQL pour récupérer le rôle de l'utilisateur par son email
    $sql = "SELECT admin.role FROM admin
            INNER JOIN client ON admin.client_id = client.id
            WHERE client.mail = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Liez l'email au paramètre de la requête
    $stmt->bind_param("s", $email);

    // Exécutez la requête
    if ($stmt->execute()) {
        // Liaison du résultat à une variable
        $stmt->bind_result($role);

        // Récupérez le rôle de l'utilisateur
        if ($stmt->fetch()) {
            return $role;
        } else {
            return null; // L'utilisateur n'a pas été trouvé
        }
    } else {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }
}

}
?>
