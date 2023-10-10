document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'fr'
    });
    calendar.render();
         // Afficher le formulaire pour ajouter un événement
            var eventForm = document.getElementById('eventForm');
            var addEventBtn = document.getElementById('addEventBtn');

            addEventBtn.addEventListener('click', function() {
                var eventName = document.getElementById('eventName').value;
                var eventStartDate = document.getElementById('eventStartDate').value;
                var eventEndDate = document.getElementById('eventEndDate').value;

                if (eventName && eventStartDate && eventEndDate) {
                    calendar.addEvent({
                        title: eventName,
                        start: eventStartDate,
                        end: eventEndDate
                    });

                    // Effacer le formulaire
                    document.getElementById('eventName').value = '';
                    document.getElementById('eventStartDate').value = '';
                    document.getElementById('eventEndDate').value = '';

      
         }
     });
 });
