<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "restaurant_db"; // adapte le nom si besoin

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>