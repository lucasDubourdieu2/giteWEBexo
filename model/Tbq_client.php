<?php

/**
 * @author RUIZ Anthony <ruiza@3il.fr>
 * @package Gestion des comptes
 * @date 04-10-2023
 */
include("../model/db-config.php");
class TbqClient
{
    /**
     * Vérifie la connexion de l'utilisateur.
     * 
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des comptes
     * @date 04-10-2023
     * @param string $mail L'adresse e-mail de l'utilisateur.
     * @param string $password Le mot de passe saisi par l'utilisateur.
     *
     * @return bool Retourne true si la connexion est réussie, sinon false.
     */
    public static function verifierConnexion($mail, $password)
    {
        global $conn; 
        $query = "SELECT mot_de_passe FROM client WHERE mail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $mail);

        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($hashedPasswordFromDatabase);
                $stmt->fetch();

                if (password_verify($password, $hashedPasswordFromDatabase)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Obtient le rôle d'un utilisateur par son adresse e-mail.
     * 
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des comptes
     * @date 04-10-2023
     *
     * @param string $email L'adresse e-mail de l'utilisateur.
     *
     * @return string|null Retourne le rôle de l'utilisateur ou null s'il n'est pas trouvé.
     */
    public static function getRoleByEmail($email)
    {
        global $conn;
        $sql = "SELECT admin.role FROM admin
            INNER JOIN client ON admin.client_id = client.id
            WHERE client.mail = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $stmt->bind_result($role);

            if ($stmt->fetch()) {
                return $role;
            } else {
                return null;
            }
        } else {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
    }
}
