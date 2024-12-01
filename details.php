<?php
 require_once('header.php');
 require_once('connection.php');



// Récupérer l'identifiant de la voiture depuis l'URL
if (isset($_GET['id'])) {
    $voitureId = $_GET['id'];
} else {
    // Rediriger vers une autre page si l'identifiant n'est pas spécifié
    header('Location: index.php');
    exit();
}

// Requête SQL pour récupérer les détails de la voiture correspondante à partir de l'identifiant
$sql = "SELECT * FROM voitures WHERE id = :voitureId";
$req = $bdd->prepare($sql);
$req->bindParam(':voitureId', $voitureId);
$req->execute();

$voiture = $req->fetch();

if (!$voiture) {
    // Rediriger vers une autre page si la voiture n'existe pas
    header('Location: index.php');
    exit();
}

$imageData = $voiture['image_url'];
$marque = $voiture['marque'];
$modele = $voiture['modele'];
$km = number_format((float) $voiture['km'], 0, ',', ' ');
$annee = $voiture['annee'];
$prix = number_format((float) $voiture['prix'], 0, ',', ' ');
$description = $voiture['description'];

?>



<div class="container">
    <h1>Détails de la voiture</h1>
    <br>
    <div class="row">
        <div class="col-md-6 img-details">
            <img src="data:image/jpeg;base64,
            <?php echo base64_encode($imageData); ?>"
             alt="Voiture" id="image-details">
        </div>
        <div class="col-md-6 div-details">
            <h2><?php echo $marque.' '.$modele; ?></h2>
            <p><strong>Kilométrage:</strong> <?php echo $km; ?> km</p>
            <p><strong>Année:</strong> <?php echo $annee; ?></p>
            <p><strong>Prix:</strong> <?php echo $prix; ?> €</p>
            <p><strong>Description:</strong><?php echo' '. $description; ?></p>
        </div>
    </div>
</div>
<?php include_once('occas-form.php');?>


<?php require_once('footer.php');?>
  <style>
    .noms{
        text-align: center;
        width: 49%;
    }
    .border-div{
        margin: 5%;
    }
  </style>