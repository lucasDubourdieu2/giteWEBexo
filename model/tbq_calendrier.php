<?php

/**
 * @author LDU
 * @date 18-10-2023
 */
include("../model/db-config.php");
class tbqCalendrier
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

    
    /**
     * Insere une réservation dans la BD
     */
    public function insertDateCalendrier($nom, $dateDeb, $dateFin) {

       $sql = "INSERT INTO disponibilites (nom, dateDeb, dateFin) VALUES (?, ?, ?)";
       $stmt = $this->db->prepare($sql);

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
     * Supprime une réservation de la BD
     */
    public function supDateCalendrier($nom, $dateDeb, $dateFin) {
    

       $sql = "DELETE FROM disponibilites 
               WHERE nom = ?
               AND dateDeb = ? 
               AND dateFin = ?";
       $stmt = $this->db->prepare($sql);

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
     * Determine si une date saisie existe déjà
     */
    public function dateExist($nom, $dateDeb, $dateFin) {
    
        $sql = "SELECT * FROM disponibilites 
                WHERE dateDeb = ? 
                AND dateFin = ?";
        $stmt = $this->db->prepare($sql);

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
     * Recupère toute les réservations sous la forme d'un tableau
     * (Utile pour la'affichage sur le calendrier des réservations)
     */
    public function recupDateCalendrier() {
      
            $reservations = array();
        
            $sql = "SELECT nom, dateDeb, dateFin FROM disponibilites"; 
            $result = $this->db->query($sql);
        
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $reservations[] = array(
                        'title' => $row['nom'] ,
                        'start' => $row['dateDeb']  . 'T00:00:00',
                        'end' => $row['dateFin'] . 'T23:59:59'
                    );
                }
                $result->free();
            }
        
            return $reservations;
        
        
    }
} 