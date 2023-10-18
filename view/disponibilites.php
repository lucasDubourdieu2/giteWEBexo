<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <title>Gite Figuies</title>
    <link rel="stylesheet" href="../css/front_header.css">
    <link rel="stylesheet" href="../css/front_footer.css">
    <link rel="stylesheet" href="../css/disponibilites.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script type="module" src="../js/calendar.js"></script>
</head>

<body>
    <header>
        <?php include '../includes/front-header.php'; ?>
    </header>
    <main>
        <div id='calendar'></div>
        <?php
            // Vérifiez l'état de la session
            if (isset($_SESSION['utilisateur_connecte']) && $_SESSION['utilisateur_connecte'] === true) {
                // Vérifiez le rôle de l'utilisateur
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            ?>
        <form action="../controller/calendrier.php" method="POST" id="eventForm">
            <label for="eventName">Nom de l'événement:</label>
            <input name="nom" type="text" id="eventName" required>
            <label for="eventStartDate">Date de début:</label>
            <input name="dateDeb" type="date" id="eventStartDate" required>
            <label for="eventEndDate">Date de fin:</label>
            <input name="dateFin" type="date" id="eventEndDate" required>
<!--            <button  type="submit" id="addEventBtn">Ajouter l'événement</button> -->
            <button  type="submit" >Ajouter l'événement</button>
     </form>

     <?php
                }
            }
     ?>
    </main>

    <footer>
        <?php include '../includes/front-footer.php'; ?>
    </footer>
</body>

</html>