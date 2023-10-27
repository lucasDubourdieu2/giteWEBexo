<?php
session_start();
if (!isset($_SESSION['utilisateur_connecte']) || $_SESSION['utilisateur_connecte'] !== true || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../view/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pannel admin accueil</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<a href="../view/index.php">Accueil</a>
<h1>Page administrateur de la modification des rubriques de la page d'accueil</h1>
    <form action="../controller/upload_accueil.php" method="POST" enctype="multipart/form-data">
        <h2>Mise en ligne des informations</h2>
        <br />
        <label for="modif_tarifAccroche">Phrase accroche tarif :</label>
        <input type="text" name="modif_tarifAccroche" id="modif_tarifAccroche">
        <br />
        <label for="modif_introAccroche">Phrase accroche intro :</label>
        <input type="text" name="modif_introAccroche" id="modif_introAccroche">
        <br />
        <label for="modif_intro">texte intro :</label>
        <input type="text" name="modif_intro" id="modif_intro">
        <br />
        <label for="modif_capacite">Capacité :</label>
        <input type="text" name="modif_capacite" id="modif_capacite">
        <br />
        <label for="modif_equipementEtService">Equipements et services :</label>
        <input type="text" name="modif_equipementEtService" id="modif_equipementEtService">
        <br />
        <label for="modif_langue">Langue :</label>
        <input type="text" name="modif_langue" id="modif_langue">
        <br />
        <label for="modif_tarifs">Tarifs :</label>
        <input type="text" name="modif_tarifs" id="modif_tarifs">
        <br />
        <label for="modif_MoyenDePaiement">Moyen de paiement :</label>
        <input type="text" name="modif_MoyenDePaiement" id="modif_MoyenDePaiement">
        <br />
        <label for="modif_saison">Saison :</label>
        <input type="text" name="modif_saison" id="modif_saison">
        <br />
        <input type="submit" name="miseAJour" value="Mettre à jour">
    </form>
</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function () {;
        var modif_tarifAccroche = document.getElementById("modif_tarifAccroche");
        var modif_introAccroche = document.getElementById("modif_introAccroche");
        var modif_intro = document.getElementById("modif_intro");
        var modif_capacite = document.getElementById("modif_capacite");
        var modif_equipementEtService = document.getElementById("modif_equipementEtService");
        var modif_langue = document.getElementById("modif_langue");
        var modif_tarifs = document.getElementById("modif_tarifs");
        var modif_MoyenDePaiement = document.getElementById("modif_MoyenDePaiement");
        var modif_saison = document.getElementById("modif_saison");

        // Fonction pour effectuer la requête AJAX
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../controller/get_latest_accueil.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    if (data) {
                        modif_tarifAccroche.value = data.tarifAccroche;
                        modif_introAccroche.value = data.introAccroche;
                        modif_intro.value = data.intro;
                        modif_capacite.value = data.capacite;
                        modif_equipementEtService.value = data.equipementEtService;
                        modif_langue.value = data.langue;
                        modif_tarifs.value = data.tarifs;
                        modif_MoyenDePaiement.value = data.moyenDePaiement;
                        modif_saison.value = data.saison;
                    }
                }
            };
            xhr.send();
        }
        fetchData();
    });
</script>
