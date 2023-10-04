<?php
include("../model/db-config.php");

class TbqVisuel
{
    private $db; // Propriété pour stocker la connexion à la base de données

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insertImage($image_url, $image_alt)
    {
        // Préparation de la requête SQL pour l'insertion
        $sql = "INSERT INTO images (image_url, image_alt) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        // Liaison des valeurs aux paramètres de la requête
        $stmt->bind_param("ss", $image_url, $image_alt);

        // Exécution de la requête d'insertion
        if ($stmt->execute()) {
            return true; // L'insertion a réussi
        } else {
            return false; // L'insertion a échoué
        }
    }

    public function deleteImage($id)
    {
        // Préparation de la requête SQL pour la suppression de l'image
        $sql = "DELETE FROM images WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        // Liaison de l'ID de l'image au paramètre de la requête
        $stmt->bind_param("i", $id);

        // Exécution de la requête de suppression
        if ($stmt->execute()) {
            return true; // La suppression a réussi
        } else {
            return false; // La suppression a échoué
        }
    }

    public function getImagesFromDatabase($columns = "*")
    {
        // Préparation de la requête SQL
        $sql = "SELECT $columns FROM images";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        // Exécution de la requête
        if ($stmt->execute()) {
            // Liaison des résultats à des variables
            $stmt->bind_result($id, $image_url, $image_alt);

            // Initialiser un tableau pour stocker les images
            $images = array();

            // Récupérer les images dans le tableau
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

    public function getImagePathById($id)
{
    // Préparation de la requête SQL
    $sql = "SELECT image_url FROM images WHERE id = ?";
    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $this->db->error);
    }

    // Liaison de l'ID au paramètre de la requête
    $stmt->bind_param("i", $id);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Liaison des résultats à des variables
        $stmt->bind_result($image_url);

        // Récupérer le chemin du fichier
        if ($stmt->fetch()) {
            return $image_url;
        } else {
            return null; // L'image n'a pas été trouvée
        }
    } else {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }
}

public function updateImageName($image_id, $new_image_name)
{
    // Préparation de la requête SQL pour la mise à jour du nom de l'image
    $sql = "UPDATE images SET image_url = ? WHERE id = ?";
    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $this->db->error);
    }

    // Liaison des valeurs aux paramètres de la requête
    $stmt->bind_param("si", $new_image_name, $image_id);

    // Exécution de la requête de mise à jour
    if ($stmt->execute()) {
        return true; // La mise à jour a réussi
    } else {
        return false; // La mise à jour a échoué
    }
}

public function getLastInsertedId()
{
    return $this->db->insert_id;
}


}
