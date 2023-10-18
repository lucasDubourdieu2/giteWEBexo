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
    public function insererAbonner($nom, $email)
    {
        $existingSubscriber = $this->verifExistenceAbonner($email);

        if ($existingSubscriber) {
            header('Location: ../view/newsletter.php?errorEmailDejaUtiliser');
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
    private function verifExistenceAbonner($email)
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

    // Fonction pour recuperer dans un fichier csv tout les mails de la table newsletter
    public function telechargerAbonnesCSV() {
        $sql = "SELECT nom, email FROM newsletter";
        $result = $this->db->query($sql);
    
        if ($result) {
            $abonnes = $result->fetch_all(MYSQLI_ASSOC);
    
            // Générer le fichier CSV
            $csvFileName = 'abonnes_newsletter.csv';
            $csvFile = fopen($csvFileName, 'w');
    
            if ($csvFile) {
                // En-têtes du fichier CSV
                fputcsv($csvFile, array('Nom', 'Email'));
    
                // Écrire les données de la table dans le fichier CSV
                foreach ($abonnes as $abonne) {
                    fputcsv($csvFile, $abonne);
                }
    
                // Fermer le fichier CSV
                fclose($csvFile);
    
                // Télécharger le fichier CSV
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="' . $csvFileName . '"');
                readfile($csvFileName);
    
                // Supprimer le fichier CSV temporaire
                unlink($csvFileName);
            }
        }
    }
    
}
