<?php

/**
 * @author RUIZ Anthony <ruiza@3il.fr>
 * @package Gestion des newsletter
 * @date 04-10-2023
 */
include("db-config.php");

class TbqNewsletter
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Insère un nouvel abonné à la newsletter.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * @param string $nom Le nom de l'abonné.
     * @param string $email L'adresse e-mail de l'abonné.
     */
    public function insererAbonner($nom, $email)
    {
        global $conn;
        $existingSubscriber = $this->verifExistenceAbonner($email);

        if ($existingSubscriber) {
            $_SESSION["emailDejaUtiliser"] = "L'e-mail saisi a déjà été enregistré";
        } else {
            $sql = "INSERT INTO newsletter (nom, email) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Erreur de préparation de la requête : " . $this->db->error);
            }

            $stmt->bind_param("ss", $nom, $email);

            if ($stmt->execute()) {
                $_SESSION["emailValide"] = "L'inscription a bien été effectuer";
            } else {
                $_SESSION["erreurInscription"] = "Une erreur est survenue lors de l'inscription, veuillez réessayer";
            }
        }
    }

    /**
     * Vérifie si l'e-mail existe déjà dans la base de données des abonnés à la newsletter.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * @param string $email L'adresse e-mail à vérifier.
     * @return bool true si l'e-mail existe déjà, sinon false
     */
    private function verifExistenceAbonner($email)
    {
        global $conn;
        $sql = "SELECT id FROM newsletter WHERE email = ?";
        $stmt = $conn->prepare($sql);

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

    /**
     * Télécharge un fichier CSV contenant les informations des abonnés à la newsletter.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * Le  fichier CSV contient les noms et les adresses e-mail des abonnés.
     */    
    public function telechargerAbonnesCSV()
    {
        global $conn;
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
                fclose($csvFile);
                // Télécharge le fichier CSV
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="' . $csvFileName . '"');
                readfile($csvFileName);
                // Supprimer le fichier CSV temporaire
                unlink($csvFileName);
            }
        }
    }
}
