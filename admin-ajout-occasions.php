<?php
include_once('header-admin.php');
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier les autorisations de l'administrateur (tu peux personnaliser cette vérification selon tes besoins)
    $isAdmin = true; // Exemple: ici on suppose que l'utilisateur est un administrateur

    if ($isAdmin) {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=ecf-garage', 'root', '');
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }

        // Vérifier si une image a été téléchargée
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            

            // Échapper les caractères spéciaux dans les données avant de les insérer dans la requête SQL
            $marque = $_POST['marque'];
            $modele = $_POST['modele'];
            $energie = $_POST['energie'];
            $km = $_POST['km'];
            $annee = $_POST['annee'];
            $prix = $_POST['prix'];
            $description = $_POST['description'];

            // Préparer et exécuter la requête d'insertion
            $stmt = $bdd->prepare("INSERT INTO voitures (image_url, marque, modele, energie, km, annee, prix, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $imageData, PDO::PARAM_LOB);
            $stmt->bindParam(2, $marque);
            $stmt->bindParam(3, $modele);
            $stmt->bindParam(4, $energie);
            $stmt->bindParam(5, $km);
            $stmt->bindParam(6, $annee);
            $stmt->bindParam(7, $prix);
            $stmt->bindParam(8, $description);
            $stmt->execute();

            // Rediriger vers une page de succès ou afficher un message de succès
            echo 'Bien ajouté';
            exit();
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Accès non autorisé.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une voiture</title>
</head>
<body>
    <h1 class="text-center">Ajouter une voiture</h1>

    <form method="POST" enctype="multipart/form-data">
      
        <div>
            <label for="image">Image </label>
            <input type="file" name="image" id="files" required>
        </div> 
            <div>
            <label for="marque">Marque </label>
            <input type="text" name="marque" required>
            </div>
            <div>
            <label for="modele">Modele </label>
            <input type="text" name="modele" required>
        </div>
        
        <div>
            <label for="energie">Energie </label>
        <select name="energie" id="energie">
            <option value="Choisir">Choisir</option>
            <option value="Diesel">Diesel</option>
            <option value="Essence">Essence</option>
            <option value="GPL">GPL</option>
            <option value="Gazole">Gazole</option> 
            <option value="Electrique">Electique</option>
            <option value="Hybride">Hybride</option>
        </select>
        </div>
        <div>
            <label for="km">Kilométrage </label>
            <input type="number" name="km" required>
        </div>
        <div>
            <label for="annee">Année </label>
            <input type="number" name="annee" required>
        </div>
        <div>
            <label for="prix">Prix </label>
            <input type="number" name="prix" required>
        </div>
        <div>
            <label for="description">Description de la voiture</label>
            <br>
            <br>
            <textarea name="description"></textarea>
        </div>
        <div>
            <input type="submit" value="Ajouter">
        </div>
    </form>
</body>
</html>
