<?php
session_set_cookie_params(1200);
session_start(); 

include('../model/tbq_calendrier.php');

$tbqCalendrier = new tbqCalendrier($conn);
$events = $tbqCalendrier->recupDateCalendrier();

foreach ($events as &$event) {
    $event['color'] = '#58351A'; 
}

header('Content-Type: application/json');
echo json_encode($events);


?>


