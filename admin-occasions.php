<?php 

require_once('connection.php');
include_once('header-admin.php');


// Variable pour stocker l'annonce en cours de modification
$annonceToEdit = null;

// Affichage du formulaire de modification
if (isset($_POST['action']) && $_POST['action'] === 'modifierForm' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("SELECT * FROM voitures WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
    $annonceToEdit = $stmt->fetch();
}

// Ajout d'une nouvelle annonce
if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST['action']) && isset($_POST['marque'])) {
    $stmt = $bdd->prepare("INSERT INTO voitures (marque, modele, energie, km, annee, prix, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['marque'],
        $_POST['modele'],
        $_POST['energie'],
        $_POST['km'],
        $_POST['annee'],
        $_POST['prix'],
        $_POST['description']
    ]);
}

// Mise à jour d'une annonce existante
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'modifier' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("UPDATE voitures SET marque = ?, modele = ?, energie = ?, km = ?, annee = ?, prix = ?, description = ? WHERE id = ?");
    $stmt->execute([
        $_POST['marque'],
        $_POST['modele'],
        $_POST['energie'],
        $_POST['km'],
        $_POST['annee'],
        $_POST['prix'],
        $_POST['description'],
        $_POST['id']
    ]);
}

// Suppression d'une annonce
if (isset($_POST['action']) && $_POST['action'] === 'supprimer' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("DELETE FROM voitures WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

// Récupération de toutes les annonces
$recupAnnonces = $bdd->query("SELECT * FROM voitures");
$annonces = $recupAnnonces->fetchAll();

?>

<div class="container">
    <!-- Formulaire de modification -->
    <?php if ($annonceToEdit): ?>
        <form method="post">
            <label for="marque">Marque</label>
            <input type="text" name="marque" value="<?= htmlspecialchars($annonceToEdit['marque']) ?>" required>
            <label for="modele">Modèle</label>
            <input type="text" name="modele" value="<?= htmlspecialchars($annonceToEdit['modele']) ?>" required>
            <label for="energie">Énergie</label>
            <input type="text" name="energie" value="<?= htmlspecialchars($annonceToEdit['energie']) ?>" required>
            <label for="km">Kilométrage</label>
            <input type="number" name="km" value="<?= htmlspecialchars($annonceToEdit['km']) ?>" required>
            <label for="annee">Année</label>
            <input type="number" name="annee" value="<?= htmlspecialchars($annonceToEdit['annee']) ?>" required>
            <label for="prix">Prix</label>
            <input type="number" name="prix" value="<?= htmlspecialchars($annonceToEdit['prix']) ?>" required>
            <label for="description">Description</label>
            <textarea name="description" required><?= htmlspecialchars($annonceToEdit['description']) ?></textarea>
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id" value="<?= $annonceToEdit['id'] ?>">
            <input type="submit" value="Mettre à jour">
        </form>
    <?php endif; ?>

    <!-- Bouton pour ajouter une annonce -->
    <button onclick="window.location.href='admin-ajout-occasions.php';">Ajouter une annonce</button>

    <!-- Liste des annonces -->
    <div class="row">
        <?php foreach ($annonces as $annonce): ?>
            <div class="col-md-4">
                <div class="card">
                    <h3><?= htmlspecialchars($annonce['marque']) ?> - <?= htmlspecialchars($annonce['modele']) ?></h3>
                    <p>Énergie: <?= htmlspecialchars($annonce['energie']) ?></p>
                    <p>Kilométrage: <?= htmlspecialchars($annonce['km']) ?> km</p>
                    <p>Année: <?= htmlspecialchars($annonce['annee']) ?></p>
                    <p>Prix: <?= htmlspecialchars($annonce['prix']) ?> €</p>
                    <p>Description: <?= htmlspecialchars($annonce['description']) ?></p>
                    <form method="post">
                        <input type="hidden" name="action" value="modifierForm">
                        <input type="hidden" name="id" value="<?= $annonce['id'] ?>">
                        <button type="submit">Modifier</button>
                    </form>
                    <form method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">
                        <input type="hidden" name="action" value="supprimer">
                        <input type="hidden" name="id" value="<?= $annonce['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
