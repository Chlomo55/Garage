<?php
try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=ecf-garage', 'root', '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}



