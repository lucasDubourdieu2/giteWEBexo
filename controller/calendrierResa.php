<?php

session_start(); 

include('../model/tbq_calendrier.php');

$tbqCalendrier = new tbqCalendrier($conn);
$events = $tbqCalendrier->recupDateCalendrier();

foreach ($events as &$event) {
    $event['color'] = 'gray'; 
}

header('Content-Type: application/json');
echo json_encode($events);


?>


