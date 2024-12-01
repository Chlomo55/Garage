<?php
require_once('connection.php');

$minPrice = $_POST['minPrice'] ?? 0;
$maxPrice = $_POST['maxPrice'] ?? 50000;
$minYear = $_POST['minYear'] ?? 1990;
$maxYear = $_POST['maxYear'] ?? date('Y');
$minKm = $_POST['minKm'] ?? 0;
$maxKm = $_POST['maxKm'] ?? 500000;
$sort = $_POST['sort'] ?? '';

$query = "SELECT * FROM voitures WHERE prix BETWEEN ? AND ? AND annee BETWEEN ? AND ? AND km BETWEEN ? AND ?";

switch ($sort) {
    case 'price_asc':
        $query .= " ORDER BY prix ASC";
        break;
    case 'price_desc':
        $query .= " ORDER BY prix DESC";
        break;
    case 'km_asc':
        $query .= " ORDER BY km ASC";
        break;
    case 'km_desc':
        $query .= " ORDER BY km DESC";
        break;
    case 'date_desc':
        $query .= " ORDER BY date_publication DESC";
        break;
}

$stmt = $bdd->prepare($query);
$stmt->execute([$minPrice, $maxPrice, $minYear, $maxYear, $minKm, $maxKm]);

$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($cars as $car) {
    if (!empty($car['image_url'])) {
        // Convertir les données LONGBLOB en Base64
        $imageData = base64_encode($car['image_url']);
        $image = "data:image/jpeg;base64,{$imageData}";
    } else {
        // Utiliser une image par défaut si aucune image n'est disponible
        $image = 'path/to/default-image.jpg'; // Remplacez par le chemin de votre image par défaut
    }

    echo "<div class='col car-card'>
            <div class='card'>
                <img src='{$image}' class='card-img-top' alt='{$car['marque']}'>
                <div class='card-body'>
                    <h5 class='card-title'>{$car['marque']} - {$car['modele']}</h5>
                    <p class='card-text'>Prix: {$car['prix']} €</p>
                    <p class='card-text'>Année: {$car['annee']}</p>
                    <p class='card-text'>Kilométrage: {$car['km']} km</p>
                </div>
            </div>
        </div>";
}
