<?php

/**
 * @author RUIZ Anthony <ruiza@3il.fr>
 * @package Gestion des images du carousel
 * @date 04-10-2023
 */
include("../model/db-config.php");

class TbqVisuel
{
    private $db;

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "giteAveyron";
    


    public function __construct($db)
    {
       $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
       $this->db = $conn;
    }

    

    public function insertDateCalendrier($nom, $dateDeb, $dateFin) {
        // Préparation de la requête SQL pour l'insertion
       $sql = "INSERT INTO disponibilites (nom, dateDeb, dateFin) VALUES (?, ?, ?)";
       $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        // Liaison des valeurs aux paramètres de la requête
        $stmt->bind_param("sss", $nom, $dateDeb, $dateFin);
      

        // Exécution de la requête d'insertion
        if ($stmt->execute()) {
            return true; // L'insertion a réussi
        } else {
            return false; // L'insertion a échoué
        }

    }

    /**
     * Insère une image dans la base de données.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * @param string $image_url L'URL de l'image à insérer.
     * @param string $image_alt Le texte alternatif de l'image.
     *
     * @return bool Retourne true si l'insertion est réussie, sinon false.
     */
    public function insertImage($image_url, $image_alt)
    {
        // Préparation de la requête SQL pour l'insertion
        $sql = "INSERT INTO images (image_url, image_alt) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("ss", $image_url, $image_alt);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Supprime une image de la base de données par son ID.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * @param int $id L'ID de l'image à supprimer.
     *
     * @return bool Retourne true si la suppression est réussie, sinon false.
     */
    public function deleteImage($id)
    {
        $sql = "DELETE FROM images WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Récupère les images depuis la base de données.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * @param string $columns Les colonnes à récupérer (par défaut, toutes les colonnes).
     *
     * @return array Un tableau contenant les images récupérées.
     */
    public function getImagesFromDatabase($columns = "*")
    {
        $sql = "SELECT $columns FROM images";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        if ($stmt->execute()) {
            $stmt->bind_result($id, $image_url, $image_alt);

            $images = array();

            while ($stmt->fetch()) {
                $images[] = array(
                    'id' => $id,
                    'image_url' => $image_url,
                    'image_alt' => $image_alt
                );
            }
            return $images;
        } else {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
    }

    /**
     * Obtient le chemin de l'image par son ID.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * @param int $id L'ID de l'image à récupérer.
     *
     * @return string|null Retourne le chemin de l'image ou null si elle n'est pas trouvée.
     */
    public function getImagePathById($id)
    {
        $sql = "SELECT image_url FROM images WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->bind_result($image_url);

            if ($stmt->fetch()) {
                return $image_url;
            } else {
                return null;
            }
        } else {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
    }

    /**
     * Met à jour le nom de l'image par son ID.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * @param int $image_id L'ID de l'image à mettre à jour.
     * @param string $new_image_name Le nouveau nom de l'image.
     *
     * @return bool Retourne true si la mise à jour est réussie, sinon false.
     */
    public function updateImageName($image_id, $new_image_name)
    {
        $sql = "UPDATE images SET image_url = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("si", $new_image_name, $image_id);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false;
        }
    }

    /**
     * Obtient l'ID de la dernière image insérée.
     *
     * @author RUIZ Anthony <ruiza@3il.fr>
     * @package Gestion des images du carousel
     * @date 04-10-2023
     * @return int L'ID de la dernière image insérée.
     */
    public function getLastInsertedId()
    {
        return $this->db->insert_id;
    }
}
