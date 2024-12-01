</body>
<div class="container">
  <footer class="row row-cols-1 row-cols-sm-2  py-5 my-5 border-top center-footer">

    <div class="col mb-2">
    <?php include_once('horaires.php');?>
    </div>

  <?php require_once('contact.php') ?>

    <div class="col mb-2">
      <h5>Adresse</h5>
      <p> <?= $adresse?> <a href="tel:<?=$tel?>"><?=$tel?></a></p>
    </div>
    <div class="col mb-6">
       <div>
        <?php include_once('contact-form.php');?>
       </div>
    </div>
  </footer>
  
</div>

</html>


