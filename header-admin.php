<?php
session_start();

if (!isset($_SESSION["user"]) || 
    ($_SESSION["user"]["is_admin"] != 1 && $_SESSION["user"]["role"] != "employe")) {
    die("Accès refusé");
}

include_once('style-admin.php');
require_once('connection.php');
?>


<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace ADMIN</title>
    <!-- <link rel="icon" href="favicon-32x32.png" type="image/png"> -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
  
  <body>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0 text-center">
    <a href="espace-admin.php" class="nav-link px-2">
        Acceuil
    </a>
</div>

      
      
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <!-- <li><a href="espace-admin.php" class="nav-link px-2">Acceuil</a></li> -->
      <?php if ($_SESSION["user"]["is_admin"] == 1) { ?>
        <li><a href="admin-users.php" class="nav-link active">Gestion des comptes</a></li>
        <li><a href="admin-horaires.php" class="nav-link px-2">Horaires</a></li>
        <li><a href="admin-services.php" class="nav-link px-2">Services du garage</a></li>
        <li><a href="admin-form.php" class="nav-link px-2">Demandes de contact</a></li> <?php }?>
        <li><a href="admin-occasions.php" class="nav-link px-2">Annonces des voitures</a></li>
        <li><a href="admin-avis.php" class="nav-link px-2">Avis</a></li>
        
      </ul>

<div class="col-md-3 text-center text-md-end mb-2 mb-md-0">
    <p>Vous êtes connecté en tant que <?= $_SESSION["user"]["role"]?></p>
    <a href="index.php">Voir le site en mode visiteur</a>
</div>

    </header>
</div>
<body>
  
