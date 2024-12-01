<?php 

require_once('connection.php');
include_once('header-admin.php');

$serviceToEdit = null;

// Affichage du formulaire de modification
if(isset($_POST['action']) && $_POST['action'] == 'modifierForm' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("SELECT * FROM services WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
    $serviceToEdit = $stmt->fetch();
}

// Ajout d'un nouveau service
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['action']) && isset($_POST['nom']) && isset($_POST['description'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    $stmt = $bdd->prepare("INSERT INTO services (nom, description) VALUES (?, ?)");
    $stmt->execute([$nom, $description]);
}

// Mise à jour d'un service existant
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'modifier' && isset($_POST['nom']) && isset($_POST['description'])) {
    $stmt = $bdd->prepare("UPDATE services SET nom = ?, description = ? WHERE id = ?");
    $stmt->execute([$_POST['nom'], $_POST['description'], $_POST['id']]);
}


// Suppression d'un service
if(isset($_POST['action']) && $_POST['action'] == 'supprimer' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("DELETE FROM services WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

// Récupération de tous les services pour affichage
$sqlex = 'SELECT * FROM services ';
$recupServices = $bdd->prepare($sqlex);
$recupServices->execute();
$services = $recupServices->fetchAll();
?>

<div class="container">
    <?php if ($serviceToEdit): ?>
        <div>
        <form method="post">
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="<?= $serviceToEdit['nom'] ?>">
            <label for="description">Description</label>
            <textarea name="description"><?= $serviceToEdit['description'] ?></textarea>
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id" value="<?= $serviceToEdit['id'] ?>">
            <input type="submit" value="Mettre à jour">
        </form>
        </div>
    <?php endif; ?>

    <!-- Form pour ajouter -->
    <button id="buttonAjoutService">Ajouter un service</button>
    <div id='FormAjoutService'>
        <form method="post">
            <label for="nom">Nom</label>
            <input type="text" name="nom" required>
            <label for="description">Description</label>
            <textarea name="description" required></textarea>
            <input type="submit" value="Ajouter">
        </form>
    </div>
            
    <div class="row justify-content-center"> 
        <?php foreach($services as $service): ?>
            <div class='col-lg-4 col-md-6 col-sm-12 mb-2'> 
                <div class='card cardPerso mx-1'> 
                    <h3><?= $service['nom'] ?></h3>
                    <p><?= $service['description'] ?></p>
                        
                    <form method="post">
                        <input type="hidden" name="action" value="modifierForm">
                        <input type="hidden" name="id" value="<?= $service['id'] ?>">
                        <button type="submit" id="modifier-color">Modifier</button>
                    </form>

                    <!-- Formulaire pour supprimer -->
                    <form method="post">
                        <input type="hidden" name="action" value="supprimer">
                        <input type="hidden" name="id" value="<?= $service['id'] ?>">
                        <button type="submit" id="supprimer-color">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div> 
</div>

<script>
    // Disparition et apparition du form
    $(() => {
$('#FormAjoutService').hide();
$('#buttonAjoutService').click(function(){
$(this).hide();
$('#FormAjoutService').show();
});
$('#FormAjoutService').submit(function(){
$(this).hide();
$('#buttonAjoutService').show();
});
    });
</script>
