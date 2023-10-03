<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "giteAveyron";

$conn = new mysqli($servername, $username, $password, $database);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>