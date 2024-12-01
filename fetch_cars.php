<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'garage');
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupération des filtres
$kmMin = isset($_POST['kmMin']) && $_POST['kmMin'] !== '' ? (int)$_POST['kmMin'] : 0;
$kmMax = isset($_POST['kmMax']) && $_POST['kmMax'] !== '' ? (int)$_POST['kmMax'] : PHP_INT_MAX;
$yearMin = isset($_POST['yearMin']) && $_POST['yearMin'] !== '' ? (int)$_POST['yearMin'] : 0;
$yearMax = isset($_POST['yearMax']) && $_POST['yearMax'] !== '' ? (int)$_POST['yearMax'] : PHP_INT_MAX;
$priceMin = isset($_POST['priceMin']) && $_POST['priceMin'] !== '' ? (int)$_POST['priceMin'] : 0;
$priceMax = isset($_POST['priceMax']) && $_POST['priceMax'] !== '' ? (int)$_POST['priceMax'] : PHP_INT_MAX;

// Préparation de la requête SQL
$query = $conn->prepare("
    SELECT id, marque, modele, km, annee, prix, image_url FROM voitures
    WHERE km BETWEEN ? AND ?
    AND annee BETWEEN ? AND ?
    AND prix BETWEEN ? AND ?
");

if (!$query) {
    die("Erreur dans la requête SQL : " . $conn->error);
}

$query->bind_param("iiiiii", $kmMin, $kmMax, $yearMin, $yearMax, $priceMin, $priceMax);
$query->execute();
$result = $query->get_result();

// Construction du résultat HTML
$html = '';
while ($row = $result->fetch_assoc()) {
    // Convertir les données binaires en image
    $photoData = base64_encode($row['image_url']); // Encodez les données binaires en base64
    $photo = "<img src='data:image/jpeg;base64,{$photoData}' alt='Photo voiture' class='car-photo'>";

    $html .= "<div class='car'>
                $photo
                <h3>{$row['marque']} - {$row['modele']}</h3>
                <p>Kilométrage: {$row['km']} km</p>
                <p>Année: {$row['annee']}</p>
                <p>Prix: {$row['prix']} €</p>
                <a href='details.php?id={$row['id']}' class='details-button'>Voir les détails</a>
              </div>";
}

if ($html === '') {
    $html = "<p>Aucune voiture ne correspond aux critères.</p>";
}

echo $html;
?>
