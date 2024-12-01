<?php
session_start();

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["pass"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("Ce n'est pas un email valide");
        }

        require_once("connection.php");

        $sql = "SELECT * FROM users WHERE email = :email";
        $query = $bdd->prepare($sql);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        if (!$user || !password_verify($_POST["pass"], $user["pass"])) {
            die("Adresse mail et/ou mot de passe incorrect");
        }

        $_SESSION["user"] = [
            "id" => $user["id"],
            "pseudo" => $user["name"],
            "email" => $user["email"],
            "firstname" => $user["firstname"],
            "is_admin" => $user["is_admin"],  // Ajout de la propriété is_admin
            "role" => $user["role"]
        ];

        if ($user["is_admin"] == 1 || $user["role"] == 'employe') {
            header('Location: espace-admin.php');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

include_once('header.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <div class="form">
    <form method="post">
        <h5>Espace réservé à l'administration</h5>
    <h4>Connexion</h4>
    
    <!--email-->
    <label for="email">Email</label>
    <input type="text" name="email" 
    id="email" placeholder="Email d'utilisateur">
    
    <!--Mot de passe-->
    <label for="pass">Mot de passe</label>
    <input type="password" name="pass"
     id="pass" placeholder="Mot de passe">

     <input type="submit" value="Se connecter">


</form>
</div>
<?php include_once('footer.php');?>
</body>
</html>



<!--Style-->
<style>
 @import url('https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:wght@300;400&family=Pacifico&family=Roboto:wght@100&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    background-color: #fff;
}
.form{
    margin-top: 100px;
    display: flex;
    justify-content: center;
    height: auto;
}
    
form{
    width: 50%;
    display: flex;
    flex-direction: column;
    background-color: #E7E3DA;
    padding: 10px;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
h4, h5{
    text-align: center;
    font-size: 20px;
    margin-bottom: 20px;
}
hr{
    margin: 10px 0;
    background-color: #ccc;
    border: 0;
    height: 1px;
    width: 100%;

}
.username-div{
    display: flex;
    width: 100%;
    justify-content: space-between;
}
.username-div div{
    display: flex;
    flex-direction: column;
    width: 49%;
}
label{
    margin-bottom: 6px;

}
input{
    margin-bottom: 5px;
    padding: 10px;
    outline: 0;
    border: 1px solid rgba(0, 0, 0, 0.4);
    border-radius: 6px;
}
input:focus{
    border: 1px solid #17a2b8;
}
input[type="submit"]{
    margin-top: 15px;
    background-color: #17a2b8;
    color: #fff;
    border: 1px solid #17a2b8;
    cursor: pointer;
}
p{
    text-align: center;
    margin: 5px 0;
    font-size: 14px;
}
p a{
    text-decoration: none;
    color: #17a2b8;
}
p > a:hover{
    text-decoration: underline;
}
input::placeholder {
  text-align: center;
}
@media only screen and (max-width: 768px){
    .form{
    margin-top: 50px;
    }
    form{
    width: 70%;}
}
</style>

