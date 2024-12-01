<?php
require_once('connection.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type']) && $_POST['form_type'] == "avisForm") {
    $nom_Avis = $_POST['nom_avis'];
    $commentaire_Avis = $_POST['commentaire_avis'];
    $note = $_POST['note'];

    $stmt = $bdd->prepare("INSERT INTO avis (nom, commentaire, note) VALUES (?, ?, ?)");
    $stmt->execute([$nom_Avis, $commentaire_Avis, $note]);
    
    // Redirigez vers la même page avec un paramètre pour indiquer que le formulaire a été soumis avec succès
    header("Location: avis.php?submitted=true");
    exit;
}

if (isset($_GET['submitted']) && $_GET['submitted'] == 'true') {
    $message = 'Envoyé';
}

include_once('header.php');
?>

<?php if ($message !== 'Envoyé'): ?>
<form method="post" class="text-center" id="avisForm">
    <input type="hidden" name="form_type" value="avisForm">
    Nom: <input type="text" name="nom_avis" required><br>
    Commentaire: <textarea name="commentaire_avis" required></textarea><br>
    Note: <input type="number" name="note" min="1" max="5" required><br>
    <input type="submit" value="Soumettre">
</form>
<?php else: ?>
    <p class="text-center"><?= $message; ?></p>
<?php endif; ?>

<?php include_once('footer.php');?>
<style>
    form{
        width: 50% !important;
        margin-left: auto;
        margin-right: auto;
    }
</style>
