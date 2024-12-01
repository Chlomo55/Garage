<?php 
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type']) && $_POST['form_type'] == "formContact") {    
    $nomContact = $_POST['name_Contact'];
    $prenomContact = $_POST['firstname_Contact'];
    $emailContact = $_POST['email_Contact'];
    $telContact = $_POST['num_Contact'];
    $messageContact = $_POST['message_Contact'];

    // Ajouter les données à la base de données
    $stmt = $bdd->prepare("INSERT INTO contact (nom, prenom, email, tel, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nomContact, $prenomContact, $emailContact, $telContact, $messageContact]);

    // Réponse JSON pour éviter d'envoyer un header après du contenu
    echo json_encode(['success' => true]);
    exit;
}
?>

<h5>Contact</h5>
<div class="container mt-5">
    <div class="form-contact-div-1 text-center">
        <button class="btn btn-primary contact-button-click-1">Formulaire de contact</button>
    </div>
    <div class="div-form mt-4">
        <form method="POST" id="formContact">
            <input type="hidden" name="form_type" value="formContact">            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name_Contact">Nom</label>
                    <input type="text" class="form-control" name="name_Contact" id="name" placeholder="Nom" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="firstname_Contact">Prénom</label>
                    <input type="text" class="form-control" name="firstname_Contact" id="firstname" placeholder="Prénom" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email_Contact">Adresse mail</label>
                    <input type="email" class="form-control" name="email_Contact" id="email" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="num_Contact">Téléphone</label>
                    <input type="tel" class="form-control" name="num_Contact" id="num" placeholder="Numéro de téléphone" required>
                </div>
            </div>
            <div class="form-group">
                <label for="message_Contact">Votre message</label>
                <textarea class="form-control" name="message_Contact" id="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-success text-center">Envoyer</button>
        </form>
    </div>
    <div class="form-contact-div-2 mt-4 text-center">
        <p>Merci pour votre demande, nous essayons de vous rappeler le plus vite possible</p>
    </div>
</div>

<script>
    $(() => {
        $('.div-form').hide();
        $('.form-contact-div-2').hide();

        $('.contact-button-click-1').click(function() {
            $('.div-form').slideDown();
            $('.form-contact-div-1').hide();
        });

        $('#formContact').submit(function(event) {
            event.preventDefault(); 
            const formData = $(this).serialize();
            $.post('contact-form.php', formData, (response) => {
                const result = JSON.parse(response);
                if (result.success) {
                    $(this).slideUp();
                    $('.form-contact-div-2').fadeIn(500, () => {
                        setTimeout(() => {
                            location.reload(); // Rafraîchir la page après confirmation
                        }, 5000);
                    });
                }
            });
        });
    });
</script>
<style>
    .form-contact-div-2 {
        background-color: #2E7E32;
        color: #fff;
        padding: 20px;
        border-radius: 15px;
        font-size: 20px;
    }
    form {
        width: 100%;
    }
    .form-row {
        margin: 0;
    }
</style>
