<?php 
session_start();
require_once('header.php'); 
include_once('contact.php'); 
?>
<div class="presentation">
    <div class="acceuil">
      <h3>Garage V. Parrot</h3>
      <p>Le garage vous acceuille au <br> <?=$adresse?></p>
    </div>
  </div>  <div style="text-align: center;">
   <h3>Atelier réparations</h3></div>
<div>
<h5 class="text-center" style="padding: 10px">Le garage vous propose</h5>
        <ul class="services-list ">
            <?php 
            require_once('services.php');
            foreach ($services as $service) {
                echo '<li>' . $service['nom'] . '</li>';
            }
            ?>
        </ul>
</div>

<div style="text-align: center;">
  <a href="reparations.php"><input type="button" value="En voir plus"></a>

</div>
 
  </div>
  <!-- Affichage des témoignages approuvés -->
<div id="temoignagesApprouves">
    <h3 class="text-center" style='margin: 20px;'>Les avis de nos clients</h3>
    <?php
    $stmt = $bdd->prepare("SELECT * FROM avis WHERE approuve = TRUE");
    $stmt->execute();
    $aviss = $stmt->fetchAll();
    ?>

    <div class="container">
        <div class="row justify-content-center"> <!-- Ajout de justify-content-center pour centrer les éléments de la ligne -->
            <?php
            foreach($aviss as $avis) {?>
                <div class='col-lg-4 col-md-6 col-sm-12 mb-2'> 
                    <div class='card mx-1 avis'> 
                        <h3><?=$avis['nom']?></h3>
                        <p><?=$avis['commentaire']?></p>
                        <?php
                        $noteEtoiles = "";
                        for ($i = 0; $i < $avis['note']; $i++) {
                            $noteEtoiles .= "⭐";
                        }?>
                        <p><?=$noteEtoiles?></p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div> 
    </div>
</div> 


<?php include_once('footer.php')?>
</script>
</html>

