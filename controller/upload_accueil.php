<?php
include '../model/db-config.php';
include '../model/Tbq_index.php';

if (isset($_POST['miseAJour'])) {
    $introAccroche = $_POST['modif_introAccroche'];
    $intro = $_POST['modif_intro'];
    $capacite = $_POST['modif_capacite'];
    $equipementEtService = $_POST['modif_equipementEtService'];
    $langue = $_POST['modif_langue'];
    $tarifs = $_POST['modif_tarifs'];
    $moyenDePaiement = $_POST['modif_MoyenDePaiement'];
    $saison = $_POST['modif_saison'];

    $tbqIndex = new TbqIndex();

    $result = $tbqIndex->modifInfoAccueil($introAccroche, $intro, $capacite, $equipementEtService, $langue, $tarifs, $moyenDePaiement, $saison);

    if ($result) {
        echo "Mise à jour réussie";
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }
}
