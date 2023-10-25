<?php

/**
 * @author RUIZ Anthony <ruiza@3il.fr>
 * @package Gestion des données de la page d'accueil
 * @date 24-10-2023
 */
include("../model/db-config.php");

class TbqIndex
{
    public function recupInfoAccueil()
    {
        global $conn;
        $query = "SELECT * FROM accueil";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            return false;
        }
    }

    public function modifInfoAccueil($tarifAccroche, $introAccroche, $intro, $capacite, $equipementEtService, $langue, $tarifs, $moyenDePaiement, $saison){
        global $conn;
        $query = "UPDATE accueil SET tarifAccroche= ?, introAccroche= ?, intro=?, capacite=?, equipementEtService=?, langue=?, tarifs=?, moyenDePaiement=?, saison=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $tarifAccroche, $introAccroche, $intro, $capacite, $equipementEtService, $langue, $tarifs, $moyenDePaiement, $saison);
    
        if ($stmt->execute()) {
            return true; // Mise à jour réussie, retourne vrai
        } else {
            return false; // Erreur lors de la mise à jour, retourne faux
        }
    }
    
    public function recupDernieresInfosAccueil() {
        global $conn;
        $query = "SELECT * FROM accueil ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }
}
