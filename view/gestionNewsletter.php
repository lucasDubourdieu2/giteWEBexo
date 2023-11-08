<!DOCTYPE html>
<html>

<head>
    <title>Site web Le gite</title>
    <link rel="icon" href="../img/logo/icone.png" type="image/png">
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/newsletterAdmin.css">
</head>

<body>
    <?php include '../includes/front-header.php';
    if (!isset($_SESSION['utilisateur_connecte']) || $_SESSION['utilisateur_connecte'] !== true || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ../index.php');
        exit;
    } ?>
    <h1 class="titleNewsletter">Page administrateur de la gestion de la newsletter</h1>
    <br>
    <form class="formNews" action="../controller/dlNewsletter.php" method="POST" enctype="multipart/form-data">
        <h2>Téléchargement des mails éligibles</h2>
        <input type="hidden" name="download" value="1">
        <input id="telecharger" type="submit" value="Télécharger">
    </form>
</body>

</html>