<?php

/**
 * @author RUIZ Anthony <ruiza@3il.fr>
 * @package Gestion des newsletter
 * @date 04-10-2023
 */
include("../model/db-config.php");

class TbqNewsletter
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Fonction pour insérer un nouvel abonné à la newsletter
    public function insertSubscriber($nom, $email)
    {
        $existingSubscriber = $this->checkSubscriberExistence($email);

        if ($existingSubscriber) {
            header('Location: ../view/newsletter.php?errorEmailAlreadyUse');
        } else {
            $sql = "INSERT INTO newsletter (nom, email) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);

            if (!$stmt) {
                die("Erreur de préparation de la requête : " . $this->db->error);
            }

            $stmt->bind_param("ss", $nom, $email);

            if ($stmt->execute()) {
                header('Location: ../view/index.php');
            } else {
                header('Location: ../view/newsletter.php?errorInscription');
            }
        }
    }

    // Fonction pour vérifier si l'e-mail existe déjà dans la base de données
    private function checkSubscriberExistence($email)
    {
        $sql = "SELECT id FROM newsletter WHERE email = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $stmt->store_result();
            return $stmt->num_rows > 0; 
        } else {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
    }
}
