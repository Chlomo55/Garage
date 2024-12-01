<?php
require 'vendor/autoload.php'; // Chargez la bibliothèque MongoDB pour PHP

try {
    // Connexion à MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $database = $client->selectDatabase("Projet-Garage"); // Nom de votre base de données
    $avisCollection = $database->selectCollection("avis"); // Nom de la collection
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
