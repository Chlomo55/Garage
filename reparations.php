<?php require_once('header.php')?>

<div class="reparations-container">
    <div class="reparations-header">
        <img src="reparation-image.jpg" alt="logo réparation" class="reparation-image">
        <h2>Atelier réparations</h2>
    </div>
    
    <div class="presentation-devis">
        Besoin de réparations de la carrosserie, de la mécanique ou d’un entretien régulier? Le garage V. Parrot est là.
    </div>

    <div class="services-section">
        <h5>Le garage vous propose</h5>
        <ul class="services-list">
            <?php 
            require_once('services.php');
            foreach ($services as $service) {
                echo '<li>' . $service['nom'] . '</li>';
            }
            ?>
        </ul>
    </div>
</div>

<?php require_once('formulaire-reparation.php')?>
<?php require_once('footer.php')?>

