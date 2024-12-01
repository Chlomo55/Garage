<?php
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve'])) {
        $id = $_POST['id'];
        $stmt = $bdd->prepare("UPDATE avis SET approuve = TRUE WHERE id = ?");
        $stmt->execute([$id]);
    } elseif (isset($_POST['reject'])) {
        $id = $_POST['id'];
        $stmt = $bdd->prepare("DELETE FROM avis WHERE id = ?");
        $stmt->execute([$id]);
    }
}

$stmt = $bdd->prepare("SELECT * FROM avis WHERE approuve = FALSE");
$stmt->execute();
$reviews = $stmt->fetchAll();
?>

<?php foreach ($reviews as $review): ?>
    <div>
        <strong><?php echo $review['nom']; ?></strong><br>
        <?php echo $review['commentaire']; ?><br>
        Note: <?php echo $review['note']; ?><br>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $review['id']; ?>">
            <input type="submit" name="approve" value="Approuver">
            <input type="submit" name="reject" value="Rejeter">
        </form>
    </div>
<?php endforeach; ?>
