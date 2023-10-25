document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        events: '../controller/calendrierResa.php',
        eventColor: 'grey',
        displayEventTime: false
    });

    calendar.render();
});
