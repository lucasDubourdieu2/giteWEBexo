<?php
include("db_config.php");
class TbqClient {
    public static function verifierConnexion($username, $password) {
        global $conn; // Pour accéder à la connexion dans db_config.php
        $query = "SELECT * FROM client WHERE username = '$username' AND mot_de_passe = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows === 1) {
            return true; // Connexion réussie
        } else {
            return false; // Échec de la connexion
        }
    }
}
?>