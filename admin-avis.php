<?php 

require_once('connection.php');
include_once('header-admin.php');

// Approuver
if(isset($_POST['action']) && $_POST['action'] == 'approuver' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("UPDATE avis SET approuve = 1 WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

// Rejeter
if(isset($_POST['action']) && $_POST['action'] == 'rejeter' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("DELETE FROM avis WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

$sqlex = 'SELECT * FROM avis ';
$recupAvis = $bdd->prepare($sqlex);
$recupAvis->execute();
$aviss = $recupAvis->fetchAll();
?>

<div class="container">
        <div class="row justify-content-center"> <!-- Ajout de justify-content-center pour centrer les éléments de la ligne -->
            <?php
            foreach($aviss as $avis) {?>
                <div class='col-lg-4 col-md-6 col-sm-12 mb-2'> 
                    <div class='card cardPerso mx-1'> 
                        <h3><?=$avis['nom']?></h3>
                        <p><?=$avis['commentaire']?></p>
                        <?php
                        $noteEtoiles = "";
                        for ($i = 0; $i < $avis['note']; $i++) {
                            $noteEtoiles .= "⭐";
                        }?>
                        <p><?=$noteEtoiles?></p>
                        <form method="post">
                <input type="hidden" name="action" value="approuver">
                <input type="hidden" name="id" value="<?= $avis['id'] ?>">
                <button type="submit" style="background: green; color: white;">Approuver</button>
            </form>

            <!-- Formulaire pour rejeter -->
            <form method="post">
                <input type="hidden" name="action" value="rejeter">
                <input type="hidden" name="id" value="<?= $avis['id'] ?>">
                <button type="submit">Rejeter</button>
            </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div> 
    </div>


