<?php 

require_once('connection.php');
include_once('header-admin.php');

// Approuver
if(isset($_POST['action']) && $_POST['action'] == 'approuver' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("UPDATE avis SET approuve = 1 WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

// Supprimer
if(isset($_POST['action']) && $_POST['action'] == 'supprimer' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("DELETE FROM contact WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

$sqlex = 'SELECT * FROM contact ';
$recupContact = $bdd->prepare($sqlex);
$recupContact->execute();
$Contacts = $recupContact->fetchAll();
?>
<h3 class="text-center">Demande de recontact</h3>
<div class="container">
        <div class="row justify-content-center"> <!-- Ajout de justify-content-center pour centrer les éléments de la ligne -->
            <?php
            foreach($Contacts as $Contact) {?>
                <div class='col-lg-4 col-md-6 col-sm-12 mb-2'> 
                    <div class='card cardPerso mx-1'> 
                        <p>Nom : <?=$Contact['nom']?></p>
                        <p>Prenom : <?=$Contact['prenom']?></p>
                        <p>Email : <?=$Contact['email']?></p>
                        <p>Numéro de tel : +33<?=$Contact['tel']?></p>
                        <p>Message : <?=$Contact['message']?></p>
                        <form method="post">
                <input type="hidden" name="action" value="supprimer" class="text-center">
                <input type="hidden" name="id" value="<?= $Contact['id'] ?>">
                <button type="submit">Supprimer</button>
            </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div> 
    </div>
