<?php 

require_once('connection.php');
include_once('header-admin.php');


// Supprimer
if(isset($_POST['action']) && $_POST['action'] == 'supprimer' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("DELETE FROM contact WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

$sqlex = 'SELECT * FROM occasions ';
$recupOccasions = $bdd->prepare($sqlex);
$recupOccasions->execute();
$Occasion = $recupOccasions->fetchAll();
?>
<h3 class="text-center">Personnes interéssés</h3>
<div class="container">
        <div class="row justify-content-center"> <!-- Ajout de justify-content-center pour centrer les éléments de la ligne -->
            <?php
            foreach($Occasion as $Occasion) {?>
                <div class='col-lg-4 col-md-6 col-sm-12 mb-2'> 
                    <div class='card cardPerso mx-1'> 
                        <p>Nom : <?=$Occasion['nom']?></p>
                        <p>Prenom : <?=$Occasion['prenom']?></p>
                        <p>Email : <?=$Occasion['email']?></p>
                        <p>Numéro de tel : +33<?=$Occasion['tel']?></p>
                        <p>Message : <?=$Occasion['message']?></p>
                        <form method="post">
                <input type="hidden" name="action" value="supprimer" class="text-center">
                <input type="hidden" name="id" value="<?= $Occasion['id'] ?>">
                <button type="submit">Supprimer</button>
            </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div> 
    </div>
