<?php
include '../model/db-config.php';
include("../model/Tbq_index.php");

$tbqIndex = new TbqIndex();
$latestData = $tbqIndex->recupDernieresInfosAccueil();

if ($latestData) {
    echo json_encode($latestData);
} else {
    echo json_encode(null);
}
