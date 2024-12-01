<?php 

require_once('connection.php');


// Construire la requête SQL en fonction des filtres
$sqlQuery2 = 'SELECT * FROM services';


// Exécuter la requête avec les filtres
$AfficherServices = $bdd->prepare($sqlQuery2);
$AfficherServices->execute();
$services = $AfficherServices->fetchAll();

?>