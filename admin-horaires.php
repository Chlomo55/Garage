<?php
include_once('header-admin.php');
require_once('connection.php');

// Mise à jour des horaires si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jour = $_POST['jour'];
    $ouverture = $_POST['ouverture'];
    $fermeture = $_POST['fermeture'];
    $ouverture_pm = $_POST['ouverture_pm'];
    $fermeture_pm = $_POST['fermeture_pm'];
    $ferme = isset($_POST['ferme']) ? 1 : 0;

    $stmt = $bdd->prepare("UPDATE horaires SET ouverture = ?, fermeture = ?, ouverture_pm = ?, fermeture_pm = ?, ferme = ? WHERE jour = ?");
    $stmt->execute([$ouverture, $fermeture, $ouverture_pm, $fermeture_pm, $ferme, $jour]);
}

// Récupération des horaires existants
$stmt = $bdd->prepare("SELECT * FROM horaires ORDER BY id");
$stmt->execute();
$jours = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur - Horaires</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .jour-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Horaires d'ouverture</h2>

    <?php
    foreach ($jours as $jour) {
    ?>
    <div class='mb-3 jour-container'>
        <h3><?= $jour["jour"]; ?></h3>
        <?php
        if ($jour['ferme'] == 1) {
            echo "<span>FERMÉ</span>";
        } else {
            echo "<div><b>Matin :</b> " . $jour['ouverture'] . " - " . $jour['fermeture'] . "</div>";
            echo "<div><b>Après-midi :</b> " . $jour['ouverture_pm'] . " - " . $jour['fermeture_pm'] . "</div>";
        }
        ?>
        <button class='btn btn-primary mt-2' onclick="toggleForm('<?= $jour['jour']; ?>')">Modifier</button>
        <div id='form-<?= $jour['jour']; ?>' style='display: none;'>
            <form method="post" class="mt-3 text-center">
                <input type="hidden" name="jour" value="<?= $jour['jour']; ?>">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="ferme" id="ferme-<?= $jour['jour']; ?>" <?php echo ($jour['ferme'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="ferme-<?= $jour['jour']; ?>">Fermé</label>
                </div>
                <div id="horaires-container-<?= $jour['jour']; ?>" <?php echo ($jour['ferme'] == 1) ? 'style="display:none;"' : ''; ?>>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ouverture-<?= $jour['jour']; ?>">Ouverture (matin)</label>
                            <input type="time" class="form-control" name="ouverture" id="ouverture-<?= $jour['jour']; ?>" value="<?= $jour['ouverture']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fermeture-<?= $jour['jour']; ?>">Fermeture (matin)</label>
                            <input type="time" class="form-control" name="fermeture" id="fermeture-<?= $jour['jour']; ?>" value="<?= $jour['fermeture']; ?>">
                        </div>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input set-midnight" id="set-midnight-<?= $jour['jour']; ?>">
                        <label class="form-check-label" for="set-midnight-<?= $jour['jour']; ?>">Pas d'après-midi</label>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ouverture_pm-<?= $jour['jour']; ?>">Ouverture (après-midi)</label>
                            <input type="time" class="form-control" name="ouverture_pm" id="ouverture_pm-<?= $jour['jour']; ?>" value="<?= $jour['ouverture_pm']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fermeture_pm-<?= $jour['jour']; ?>">Fermeture (après-midi)</label>
                            <input type="time" class="form-control" name="fermeture_pm" id="fermeture_pm-<?= $jour['jour']; ?>" value="<?= $jour['fermeture_pm']; ?>">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-2">Modifier</button>
            </form>
        </div>
    </div>
    <?php
    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function toggleForm(jour) {
        $('#form-' + jour).toggle();
    }

    $('input[type="checkbox"][name="ferme"]').on('change', function() {
        var jour = $(this).next().attr('for').split('-')[1];
        if ($(this).is(':checked')) {
            $('#horaires-container-' + jour).hide();
        } else {
            $('#horaires-container-' + jour).show();
        }
    });
    
    $('.set-midnight').on('change', function() {
        var jour = $(this).attr('id').split('-')[2];
        if ($(this).is(':checked')) {
            $('#ouverture_pm-' + jour).val('00:00');
            $('#fermeture_pm-' + jour).val('00:00');
        } else {
            $('#ouverture_pm-' + jour).val('');
            $('#fermeture_pm-' + jour).val('');
        }
    });
</script>
</body>
</html>
