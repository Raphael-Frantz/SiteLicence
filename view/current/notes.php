<?php
// @need diplomes la liste des diplômes

WebPage::addOnlineScript("var WEB_PATH = '".WEB_PATH."';");
?>
<section class="mytitle text-center bg-light">
  <div class="container">
    <h2 class="mb-5">Vos notes</h2>
    <div class="alert alert-danger lead text-center mt-2" role="alert">
      Dorénavant, vous devez vous connecter pour accéder à vos notes et à votre IP (inscription pédagogique)
      <a class="btn btn-outline-primary" href="login.php">Se loguer</a>
    </div> 
  </div>
</section>