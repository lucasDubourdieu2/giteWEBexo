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
        <form id="eventForm">
            <label for="eventName">Nom de l'événement:</label>
            <input type="text" id="eventName" required>
            <label for="eventStartDate">Date de début:</label>
            <input type="date" id="eventStartDate" required>
            <label for="eventEndDate">Date de fin:</label>
            <input type="date" id="eventEndDate" required>
            <button type="button" id="addEventBtn">Ajouter l'événement</button>
     </form>
    </main>

    <footer>
        <?php include '../includes/front-footer.php'; ?>
    </footer>
</body>

</html>