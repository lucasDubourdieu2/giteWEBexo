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
    <title>Site web Le gite</title>
    <link rel="stylesheet" href="../css/newsletterAdmin.css">
    <link rel="stylesheet" href="../css/front_header.css">
</head>

<body>
    <?php include '../includes/front-header.php'; ?>
    <h1 class="titleNewsletter">Page administrateur de la gestion de la newsletter</h1>
    <form action="../controller/dlNewsletter.php" method="POST" enctype="multipart/form-data">
        <h2>Téléchargement des mails éligibles</h2>
        <input type="hidden" name="download" value="1">
        <input type="submit" value="Télécharger">
    </form>
</body>

</html>