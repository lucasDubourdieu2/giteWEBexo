<?php
include("../model/db-config.php");
include("../model/Tbq_newsletter.php");

if (isset($_POST['download']) && $_POST['download'] === '1') {
    $newsletter = new TbqNewsletter($conn);
    $newsletter->telechargerAbonnesCSV();
}

?>