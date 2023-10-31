<?php

/**
 * @author DUBOURDIEU Lucas <ruiza@3il.fr>
 * @package Gestion du calendrier de reservation
 * @date 18-10-2023
 */
include("../model/db-config.php");
class tbqCalendrier
{

    private $db;

    // private $servername = "localhost";
    // private $username = "root";
    // private $password = "";
    // private $database = "giteAveyron";



    public function __construct($db)
    {
        global $conn;
        $this->db = $conn;
    }


    /**
     * Insere une réservation dans la BD
     *
     * @author DUBOURDIEU Lucas <ruiza@3il.fr>
     * @package Gestion du calendrier de reservation
     * @date 18-10-2023
     * @return bool Retourne true si l'insertion est réussie, sinon false.
     */
    public function insertDateCalendrier($nom, $dateDeb, $dateFin)
    {
        global $conn;
        $sql = "INSERT INTO disponibilites (nom, dateDeb, dateFin) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("sss", $nom, $dateDeb, $dateFin);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Supprime une réservation du calendrier dans la base de données.
     *
     * @author DUBOURDIEU Lucas <ruiza@3il.fr>
     * @package Gestion du calendrier de reservation
     * @date 18-10-2023
     * @param string $nom Le nom de la réservation à supprimer.
     * @param string $dateDeb La date de début de la réservation à supprimer.
     * @param string $dateFin La date de fin de la réservation à supprimer.
     * @return bool Retourne true si la suppression est réussie, sinon false.
     */
    public function supDateCalendrier($nom, $dateDeb, $dateFin)
    {

        global $conn;
        $sql = "DELETE FROM disponibilites 
               WHERE nom = ?
               AND dateDeb = ? 
               AND dateFin = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("sss", $nom, $dateDeb, $dateFin);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Détermine si une réservation avec la même date de début et de fin existe déjà dans le calendrier.
     *
     * @author DUBOURDIEU Lucas <ruiza@3il.fr>
     * @package Gestion du calendrier de reservation
     * @date 18-10-2023
     * @param string $dateDeb La date de début de la réservation à vérifier.
     * @param string $dateFin La date de fin de la réservation à vérifier.
     * @return bool Retourne true si une réservation avec les mêmes dates existe, sinon false.
     */
    public function dateExist($dateDeb, $dateFin)
    {
        global $conn;
        $sql = "SELECT * FROM disponibilites 
                WHERE dateDeb = ? 
                AND dateFin = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("ss", $dateDeb, $dateFin);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Récupère toutes les réservations du calendrier sous forme d'un tableau.
     * @author DUBOURDIEU Lucas <ruiza@3il.fr>
     * @package Gestion du calendrier de reservation
     * @date 18-10-2023
     * @param string $dateDeb La date de début de la réservation à vérifier.
     * @param string $dateFin La date de fin de la réservation à vérifier.
     * @return array|false Un tableau contenant les informations des réservations ou false en cas d'erreur.
     */
    public function recupDateCalendrier()
    {
        global $conn;
        $reservations = array();

        $sql = "SELECT nom, dateDeb, dateFin FROM disponibilites";
        $result = $this->db->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reservations[] = array(
                    'title' => $row['nom'],
                    'start' => $row['dateDeb']  . 'T00:00:00',
                    'end' => $row['dateFin'] . 'T23:59:59'
                );
            }
            $result->free();
        }
        return $reservations;
    }
}
