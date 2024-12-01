<?php
include_once('header-admin.php');
require_once('connection.php');

// Logique de création d'un nouvel employé
if(isset($_POST['add_user']) && isset($_POST['new_name']) && isset($_POST['new_email']) && isset($_POST['new_password']) && isset($_POST['new_firstname'])) {
    $newName = $_POST['new_name'];
    $newFirstname = $_POST['new_firstname'];
    $newEmail = $_POST['new_email'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $sqlInsert = "INSERT INTO users(name, firstname, email, pass, role) VALUES (:new_name, :new_firstname, :new_email, :new_password, 'employe')";
    $stmt = $bdd->prepare($sqlInsert);
    $stmt->bindParam(':new_name', $newName, PDO::PARAM_STR);
    $stmt->bindParam(':new_firstname', $newFirstname, PDO::PARAM_STR);
    $stmt->bindParam(':new_email', $newEmail, PDO::PARAM_STR);
    $stmt->bindParam(':new_password', $newPassword, PDO::PARAM_STR);
    $stmt->execute();
}

// Si le formulaire pour changer le rôle est soumis
if(isset($_POST['change_role']) && isset($_POST['user_id']) && isset($_POST['new_role'])) {
    $newRole = $_POST['new_role'];
    $userId = $_POST['user_id'];

    $sqlUpdate = "UPDATE users SET role = :new_role WHERE id = :user_id";
    $stmt = $bdd->prepare($sqlUpdate);
    $stmt->bindParam(':new_role', $newRole, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}

// Si le bouton pour supprimer un utilisateur est cliqué
if(isset($_POST['delete_user']) && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    $sqlDelete = "DELETE FROM users WHERE id = :user_id";
    $stmt = $bdd->prepare($sqlDelete);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}

$sqlex = 'SELECT * FROM users';
$recupUsers = $bdd->prepare($sqlex);
$recupUsers->execute();
$Users = $recupUsers->fetchAll();
?>
<button id="buttonAjout">Ajouter un compte</button>
<!-- Formulaire de création d'utilisateur -->
<div class="container mt-5" id="formAjout">
    <h2>Créer un compte pour un employé</h2>
    <form method="post" action="">
        <div>
            <label for="new_name">Nom :</label>
            <input type="text" id="new_name" name="new_name" required>
        </div>
        <div>
            <label for="new_firstname">Prénom :</label>
            <input type="text" id="new_firstname" name="new_firstname" required>
        </div>
        <div>
            <label for="new_email">Email :</label>
            <input type="email" id="new_email" name="new_email" required>
        </div>
        <div>
            <label for="new_password">Mot de passe :</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <input type="submit" name="add_user" value="Ajouter">
    </form>
</div>
<div id="confirmAjout"><p>Employé ajouté avec succés</p></div>

<div class="container">
    <div class="row justify-content-center">
        <?php
        foreach($Users as $user) {
        ?>
        <div class='col-lg-4 col-md-6 col-sm-12 mb-2'>
        <div class='card cardPerso mx-1'>
            <h3><?=$user['name']?></h3>
            <p><?=$user['email']?></p>
            <p><?=$user['role']?></p>

            <!-- Formulaire pour changer le rôle -->
            <form method="post" action="">
                <select name="new_role">
                    <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="employe" <?= ($user['role'] == 'employe') ? 'selected' : ''; ?>>Employé</option>
                </select>
                <input type="hidden" name="user_id" value="<?=$user['id']?>">
                <input type="submit" name="change_role" value="Modifier le rôle">
            </form>

            <!-- Bouton pour supprimer l'utilisateur -->
            <form method="post" action="">
                <input type="hidden" name="user_id" value="<?=$user['id']?>">
                <input type="submit" name="delete_user" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
            </form>
        </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $("#formAjout").hide();
    $('#confirmAjout').hide();

    $("#buttonAjout").click(function(){
        $(this).hide();
        $("#formAjout").show();
    });

    $("form").submit(function(){
        $("#formAjout").hide();
        $("#buttonAjout").show();
        $('#confirmAjout').show();
    });
});
</script>

