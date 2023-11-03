<?php 
/**
 * Établit une connexion à la base de données MySQL.
 * @author RUIZ Anthony <ruiza@3il.fr>
 * @date 04-10-2023
 * @param string $servername Le nom du serveur MySQL.
 * @param string $username Le nom d'utilisateur MySQL.
 * @param string $password Le mot de passe MySQL.
 * @param string $database Le nom de la base de données MySQL.
 *
 * @return mysqli|false Un objet mysqli représentant la connexion à la base de données ou false en cas d'échec.
 */
$servername = "mysql-ruiza3il.alwaysdata.net";
$username = "ruiza3il";
$password = "GaryGavroche13300!";
$database = "ruiza3il_gitefiguies";

$conn = new mysqli($servername, $username, $password, $database);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
