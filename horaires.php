<?php 
// require_once('connection.php');
function formatHeure($heure) {
    return date('G\hi', strtotime($heure));
}

$horaires = [];
$stmt = $bdd->query("SELECT * FROM horaires ORDER BY FIELD(jour, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')");
while($row = $stmt->fetch()) {
    if ($row['ferme']) {
        $horaires[$row['jour']] = "Fermé";
    } else {
        $horaire = formatHeure($row['ouverture']) . '-' . formatHeure($row['fermeture']);
        
        // Si le magasin est ouvert le matin mais pas l'après-midi
        if ($row['ouverture_pm'] == '00:00:00' && $row['fermeture_pm'] == '00:00:00') {
            // Ne rien ajouter
        }
        // Si le magasin est ouvert l'après-midi
        elseif ($row['ouverture_pm'] && $row['fermeture_pm']) {
            $horaire .= ' et ' . formatHeure($row['ouverture_pm']) . '-' . formatHeure($row['fermeture_pm']);
        }
        
        $horaires[$row['jour']] = $horaire;
    }
}

echo '<h3>Horaires d\'ouverture</h3><ul style="list-style: none;">';
foreach ($horaires as $jour => $horaire) {
    echo '<li>' . $jour . ' : ' . $horaire . '</li>';
}
echo '</ul>';
