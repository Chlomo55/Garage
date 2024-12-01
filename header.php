<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garage V. Parrot</title>
    <link rel="icon" href="favicon-32x32.png" type="image/png">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!--Pour afficher et filtrer les voitures -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
  
  <body>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0 text-center">
    <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
        <img src="Logo_ECF_Garage.png" alt="Logo du garage">
    </a>
</div>

      
      
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link active">Acceuil</a></li>
        <li><a href="reparations.php" class="nav-link px-2">Réparations</a></li>
        <li><a href="occasions.php" class="nav-link px-2">Occasions</a></li>
        <li><a href="avis.php" class="nav-link px-2">Laisser un avis</a></li>
      </ul>

      <div class="col-md-3 text-center text-md-end mb-2 mb-md-0">
    <?php
    
    if (isset($_SESSION['user']['role'])) {
        echo "Vous êtes connecté en tant que " . $_SESSION['user']['role'];
        echo "<a href='deconnexion.php' class='btn btn-primary me-2'>Deconnexion</a>";

    } else {
    ?>
        <a href="connexion.php" class="btn btn-primary"><span><img src="icon-account.png" alt="" width>Se connecter</span></a>
    <?php
    }
    ?>
</div>

    </header>
</div>
<body>
  
