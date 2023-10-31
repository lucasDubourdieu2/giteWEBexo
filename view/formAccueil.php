<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pannel admin accueil</title>
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/formAccueil.css">
</head>

<body>
    <?php include '../includes/front-header.php';
    if (!isset($_SESSION['utilisateur_connecte']) || $_SESSION['utilisateur_connecte'] !== true || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ../view/index.php');
        exit;
    } ?>
    <div class="corpsPage">
        <h1 class="titre">Modifier les informations de la page d'accueil du gite Figuiès</h1>
        <?php
        if (!empty($_SESSION['modifOk'])) { ?>
            <p class="msgValid"><?php echo $_SESSION['modifOk']; ?></p>
        <?php $_SESSION['modifOk'] = "";
        } elseif (!empty($_SESSION['modifErreur'])) { ?>
            <p class="msgErreur"><?php echo $_SESSION['modifErreur']; ?></p>
        <?php $_SESSION['modifErreur'] = "";
        }
        ?>
        <form action="../controller/upload_accueil.php" method="POST" enctype="multipart/form-data">
            <div class="conteneurflex">
                <div class="boite">
                    <label for="modif_tarifAccroche">Phrase accroche tarif :</label>
                    <br>
                    <textarea class="zonetexte" name="modif_tarifAccroche" id="modif_tarifAccroche"></textarea>
                </div>
                <div class="boite">
                    <label for="modif_introAccroche">Phrase accroche intro :</label>
                    <br>
                    <textarea class="zonetexte" name="modif_introAccroche" id="modif_introAccroche"></textarea>
                </div>
            </div>

            <div class="conteneurflex">
                <div class="boite">
                    <label for="modif_intro">texte intro :</label>
                    <textarea class="zonetexte" name="modif_intro" id="modif_intro"></textarea>
                </div>
            </div>
            <div class="conteneurflex">
                <div class="boite">
                    <label for="modif_capacite">Capacité :</label>
                    <textarea class="zonetexte" name="modif_capacite" id="modif_capacite"></textarea>
                </div>
                <div class="boite">
                    <label for="modif_equipementEtService">Equipements et services :</label>
                    <textarea class="zonetexte" name="modif_equipementEtService" id="modif_equipementEtService"></textarea>
                </div>
            </div>

            <div class="conteneurflex">
                <div class="boite">
                    <label for="modif_langue">Langue :</label>
                    <textarea class="zonetexte" name="modif_langue" id="modif_langue"></textarea>
                </div>
                <div class="boite">
                    <label for="modif_tarifs">Tarifs :</label>
                    <textarea class="zonetexte" name="modif_tarifs" id="modif_tarifs"></textarea>
                </div>
                <div class="boite">
                    <label for="modif_MoyenDePaiement">Moyen de paiement :</label>
                    <textarea class="zonetexte" name="modif_MoyenDePaiement" id="modif_MoyenDePaiement"></textarea>
                </div>
            </div>

            <div class="conteneurflex">
                <div class="boite">
                    <label for="modif_saison">Saison :</label>
                    <textarea class="zonetexte" name="modif_saison" id="modif_saison"></textarea>
                </div>
            </div>
            <div class="conteneurflex">
                <input class="ValidationDonnee" type="submit" name="miseAJour" value="Mettre à jour">
            </div>
        </form>
    </div>
    <?php include '../includes/front-footer.php'; ?>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        ;
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
            xhr.onreadystatechange = function() {
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