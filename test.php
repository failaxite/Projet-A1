<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "database/connect.php";
?>

<!DOCTYPE html>
<link rel="stylesheet" href="test.css" />
<html>
  <head>
    <title>ThinSpace - Test</title>
  </head>
  <body>
    <h2>Formulaire Beta</h2>
    <p>
      <button class="button" data-modal="modalOne">S'inscrire a la beta !</button>
    </p>
    <div id="modalOne" class="modal">
      <div class="modal-content">
        <div class="contact-form">
          <a class="close">&times;</a>
          <form action="envoie.php" method="POST" class="envoie">
            <h2>S'inscrire a la beta</h2>
            <div>
              <input type="text" name="name" placeholder="Nom/Prenom" />
              <input type="text" name="mail" placeholder="Email" />
              <input type="text" name="tel" placeholder="Numero de telephone" />
            </div>
            <button type="submit">Envoyer</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>

<script type="text/javascript" src="test.js"></script>