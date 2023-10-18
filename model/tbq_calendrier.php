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

    

    public function insertDateCalendrier($nom, $dateDeb, $dateFin) {

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
            return true; // L'insertion a réussi
        } else {
            return false; // L'insertion a échoué
        }

    }

    public function dateExist($nom, $dateDeb, $dateFin) {
    

        $sql = "SELECT FROM disponibilites 
                WHERE nom = ?
                AND dateDeb = ? 
                AND dateFin = ?";
        $stmt = $this->db->prepare($sql);
 
         if (!$stmt) {
             die("Erreur de préparation de la requête : " . $this->db->error);
         }
 
         $stmt->bind_param("sss", $nom, $dateDeb, $dateFin);
       
         if ($stmt->execute() == NULL) {
             return true; // L'insertion a réussi
         } else {
             return false; // L'insertion a échoué
         }
 
     }

    public function recupDateCalendrier() {
      
            $reservations = array();
        
            $sql = "SELECT nom, dateDeb, dateFin FROM disponibilites"; 
            $result = $this->db->query($sql);
        
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $reservations[] = array(
                        'title' => $row['nom'],
                        'start' => $row['dateDeb'],
                        'end' => $row['dateFin']
                    );
                }
                $result->free();
            }
        
            return $reservations;
        
        
    }
}
