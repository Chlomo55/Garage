<?php 
require_once('connection.php');
require_once('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = isset($_POST['name']) ? $_POST['name'] : '';
    $prenom = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $tel = isset($_POST['num']) ? $_POST['num'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    if ($nom && $prenom && $email && $tel && $message) {
        $stmt = $bdd->prepare("INSERT INTO reparations (nom, prenom, email, tel, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $tel, $message]);
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>


<div class="div-click1">
        <button class="click1">Demander un rdv</button>
    </div>
    <div class="form">
            <form method="post" id="myForm">
            <hr>
            <div class="username-div">
                <div>
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" placeholder="Nom" required>
                </div>
                <div>
                    <label for="firstname">Prénom</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>
                </div>
            </div>
            <div class="username-div">
                <div>
                    <label for="email">Adresse mail</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div>
                    <label for="num">Numéro de téléphone</label>
                    <input type="tel" name="num" id="num" placeholder="Numéro de téléphone" required>
                </div>
            </div>
            <div class="username-div">
                <div>
                    <label for="message">Veuillez décrire ce pour quoi vous prenez rendez-vous</label>
                    <textarea name="message" required></textarea>
                </div>
                <input type="submit" value="Demander un devis" class="click2">
            </div>
        </form>
    </div>
    <div id="box-p">
       <p>Votre demande a bien été prise en compte. <br> 
    Un email de confirmation va vous être envoyé avec tous les détails. <br>
    Le garage vous recontactera pour planifier avec vous d'un rendez-vous aux horaires qui vous convienneront
    </p>
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(() => {
    $('.form').hide(); 
    $('#box-p').hide();

    $('.click1').click(function(){
        $('.form').slideDown();
        $('.div-click1').hide();
    });

    $('#myForm').submit(function(event) {
        event.preventDefault(); // Empêche la soumission réelle du formulaire

        // Cachez le formulaire
        $(this).slideUp();

        // Affichez #box-p et soumettez le formulaire après l'animation
        $('#box-p').fadeIn(500,() => {
            setTimeout(() => {
                // Cachez #box-p
                $('#box-p').fadeOut(500, () => {
                    // Soumettez le formulaire
                    event.target.submit();
                });
            }, 5000); // 60000 millisecondes = 1 minute
       
        });
    });
});
</script>
<style>
    .username-div {
    /* Cela élimine les marges par défaut autour des divs. */
    margin: 0;

    /* Cela élimine les espaces entre les divs. */
    display: flex;
    justify-content: space-between;
}

.username-div > div {
    /* Cela élimine les marges autour des éléments à l'intérieur de .username-div. */
    margin: 0;
}

#box-p {
    /* Si nécessaire, ajustez la marge et le padding pour #box-p. */
    margin: 20px 0;  /* Exemple */
    padding: 10px;   /* Exemple */
}

</style>