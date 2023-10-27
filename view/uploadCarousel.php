<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pannel admin carousel</title>
    <link rel="stylesheet" href="../css/carousel.css">
</head>
<body>
    <?php include '../includes/front-header.php'; 
    if (!isset($_SESSION['utilisateur_connecte']) || $_SESSION['utilisateur_connecte'] !== true || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ../view/index.php');
        exit;
    }?>
    <div class="corpsPage">
        <h1 class="titre2">Page administrateur de la gestion d'images du carousel</h1>
        <form action="../controller/upload_handler.php" method="POST" enctype="multipart/form-data">
            <h2>Mise en ligne d'une nouvelle image</h2>
        <label for="image">Sélectionnez une image :</label>
            <input type="file" name="image" id="image">
            <br>
            <label for="image_alt">Texte descriptif :</label>
            <input type="text" name="image_alt" id="image_alt">
            <br>
            <input type="submit" name="upload" value="Télécharger">
            <?php
        if (!empty($_SESSION['imageOk'])) { ?>
            <p class="msgValid"><?php echo $_SESSION['imageOk']; ?></p>
        <?php $_SESSION['imageOk'] = "";
        } elseif (!empty($_SESSION['erreurInsertion'])) { ?>
            <p class="msgErreur"><?php echo $_SESSION['erreurInsertion']; ?></p>
        <?php $_SESSION['erreurInsertion'] = "";
        } elseif (!empty($_SESSION['erreurTelechargement'])) { ?>
            <p class="msgErreur"><?php echo $_SESSION['erreurTelechargement']; ?></p>
        <?php $_SESSION['erreurTelechargement'] = "";
        } elseif (!empty($_SESSION['erreurExtension'])) { ?>
            <p class="msgErreur"><?php echo $_SESSION['erreurExtension']; ?></p>
        <?php $_SESSION['erreurExtension'] = "";
        } elseif (!empty($_SESSION['erreurPasImage'])) { ?>
            <p class="msgErreur"><?php echo $_SESSION['erreurPasImage']; ?></p>
        <?php $_SESSION['erreurPasImage'] = "";
        } ?>
        </form>
        <div class="tableauImg">
            <?php include('../view/tableauCarousel.php');?>
        </div>
    </div>
    <?php include '../includes/front-footer.php'; ?>
</body>
</html>