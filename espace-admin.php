<?php 
include_once('header-admin.php'); 

$role = $_SESSION['user']['role'];  // Exemple, à remplacer par votre logique appropriée
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Espace d'administration</h2>

    <?php if ($role == "admin"): ?>
        <h4 class="mb-3">Gestion de votre site</h4>

        <div class="list-group mb-4">
            <p class="list-group-item">Modifier les services du garage (réparations, vidange, etc.)</p>
            <p class="list-group-item">Modifier l'adresse et/ou le numéro de téléphone</p>
            <p class="list-group-item">Gérer les annonces de voiture (ajouter, modifier, supprimer)</p>
        </div>
    <?php else: ?>
        <h4 class="mb-3">Gestion des avis et annonces</h4>
    <?php endif; ?>

    <div class="btn-group-vertical d-block">
        <?php if ($role == "admin"): ?>
            <a href="admin-horaires.php" class="btn btn-primary mb-2">Horaires</a>
            <a href="admin-services.php" class="btn btn-primary mb-2">Services</a>
            <a href="admin-users.php" class="btn btn-primary mb-2">Comptes</a>
            <a href="admin-coordonnees-garage.php" class="btn btn-primary mb-2">Coordonnées du garage</a>
        <?php endif; ?>

        <a href="admin-avis.php" class="btn btn-primary mb-2">Avis</a>
        <a href="admin-occasions.php" class="btn btn-primary mb-2">Occasions</a>

        <?php if ($role == "admin"): ?>
            <a href="admin-demandes-rdv.php" class="btn btn-primary mb-2">Demandes de RDV</a>
            <a href="admin-form-contact.php" class="btn btn-primary mb-2">Formulaire de Contact</a>
        <?php endif; ?>
    </div>
</div>
